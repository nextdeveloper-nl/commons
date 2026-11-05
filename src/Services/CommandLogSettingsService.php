<?php

namespace NextDeveloper\Commons\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\Meta;
use NextDeveloper\IAM\Database\Models\Accounts;
use NextDeveloper\IAM\Helpers\UserHelper;
use Throwable;

/**
 * Which operations an account wants in its command history (create, update, read; delete is always logged).
 *
 * Stored in common_meta on the account (key command_logs.settings), read through a cache so the CommandHistory middleware
 * never queries the database per request: one cache GET per request, one database read per account per TTL or per change.
 * If the cache is down the platform defaults are used and the database is not touched: the history must never slow down or
 * break a request.
 */
class CommandLogSettingsService
{
    public const META_KEY = 'command_logs.settings';

    /** Operations the customer may switch. delete and system are not in this list on purpose. */
    public const SWITCHABLE = ['create', 'update', 'read'];

    /**
     * The effective settings of an account: [create, update, delete, read => bool]. delete is always true.
     *
     * @param  string|null  $accountUuid  the account's uuid (cache keys use uuids, never integer ids)
     */
    public static function forAccount(int $accountId, ?string $accountUuid): array
    {
        $defaults = self::defaults();

        if (! $accountUuid) {
            return $defaults;
        }

        $key = self::cacheKey($accountUuid);

        try {
            $store = self::store();
            $cached = $store->get($key);

            if (is_array($cached)) {
                return $cached;
            }
        } catch (Throwable $e) {
            // Cache unreachable: do not fall back to the database here, that is the per-request cost we are avoiding.
            Log::warning('[CommandLogs] settings cache unavailable, using defaults: '.$e->getMessage());

            return $defaults;
        }

        $settings = self::fromDatabase($accountId, $defaults);

        try {
            $store->put($key, $settings, (int) config('commons.command_logs.settings_ttl', 86400));
        } catch (Throwable) {
            // best effort
        }

        return $settings;
    }

    /**
     * Same as forAccount() for the account the current user acts in. Defaults when nobody is logged in.
     */
    public static function forCurrentAccount(): array
    {
        $account = UserHelper::currentAccount();

        return $account ? self::forAccount($account->id, $account->uuid) : self::defaults();
    }

    /**
     * Saves the choice of the current account. Only create, update and read are accepted; delete cannot be switched off.
     * Keys that are not sent keep their value. Clears the cache so the change applies on the next request.
     *
     * @param  array  $data  e.g. ['read' => true, 'create' => false]
     * @return array the effective settings after the change
     */
    public static function update(array $data): array
    {
        $account = UserHelper::currentAccount();

        $current = self::fromDatabase($account->id, self::defaults());

        foreach (self::SWITCHABLE as $operation) {
            if (array_key_exists($operation, $data)) {
                $current[$operation] = filter_var($data[$operation], FILTER_VALIDATE_BOOLEAN);
            }
        }

        // Stored without delete: it is not a choice. forAccount() adds it back.
        $value = array_intersect_key($current, array_flip(self::SWITCHABLE));

        $meta = self::metaRow($account->id);

        // The endpoint itself is protected by common_command_log_settings:update. A basic member has no common_meta:create or
        // :update, so the role check of the meta row is bypassed for this one write (it is still attributed to the user and
        // account by MetaService). Without this, saving the settings fails with a permission error for ordinary members.
        UserHelper::withRolesCheckBypassed(function () use ($meta, $value, $account) {
            if ($meta) {
                MetaService::update($meta->uuid, ['value' => $value]);
            } else {
                MetaService::create([
                    'object_type' => Accounts::class,
                    'object_id' => $account->id,
                    'key' => self::META_KEY,
                    'value' => $value,
                ]);
            }
        });

        try {
            self::store()->forget(self::cacheKey($account->uuid));
        } catch (Throwable $e) {
            Log::warning('[CommandLogs] could not clear the settings cache: '.$e->getMessage());
        }

        return self::forAccount($account->id, $account->uuid);
    }

    /** What an account follows until it chooses otherwise; delete is forced on. */
    public static function defaults(): array
    {
        return array_merge(
            ['create' => true, 'update' => true, 'read' => false],
            (array) config('commons.command_logs.defaults', []),
            ['delete' => true]
        );
    }

    private static function fromDatabase(int $accountId, array $defaults): array
    {
        $meta = self::metaRow($accountId);
        $stored = $meta && is_array($meta->value) ? $meta->value : [];

        // Only known switches are taken from storage; anything else in the row is ignored.
        $settings = array_merge($defaults, array_intersect_key(array_map('boolval', $stored), array_flip(self::SWITCHABLE)));
        $settings['delete'] = true;

        return $settings;
    }

    private static function metaRow(int $accountId): ?Meta
    {
        return Meta::withoutGlobalScopes()
            ->where('object_type', Accounts::class)
            ->where('object_id', $accountId)
            ->where('key', self::META_KEY)
            ->first();
    }

    private static function cacheKey(string $accountUuid): string
    {
        return CacheHelper::getKey('CommandLogSettings', $accountUuid);
    }

    private static function store()
    {
        return Cache::store(config('commons.command_logs.cache_store') ?: null);
    }
}
