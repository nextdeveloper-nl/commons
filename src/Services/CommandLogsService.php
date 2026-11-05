<?php

namespace NextDeveloper\Commons\Services;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use NextDeveloper\Commons\Database\Filters\CommandLogsQueryFilter;
use NextDeveloper\Commons\Database\Models\CommandLogs;
use NextDeveloper\Commons\Jobs\WriteCommandLogJob;
use NextDeveloper\IAM\Helpers\UserHelper;
use Throwable;

/**
 * The project-wide command history: who did what, in which module, with what result.
 *
 *  - record():  any code (a module, a job, a console command) states that something happened. Applies the account's
 *               settings, completes the entry (account, user, request) and queues the write.
 *  - note():    during an HTTP request a service attaches the object (full model class + id) and context to the entry the
 *               CommandHistory middleware writes for that request.
 *  - store():   the actual insert, called by WriteCommandLogJob. The only place that writes the table.
 *  - get():     list for GET /commons/command-logs.
 *
 * Writing the history must never break the operation it describes: record() and store() swallow and log their errors.
 */
class CommandLogsService
{
    public const OPERATIONS = ['create', 'update', 'delete', 'read', 'system'];

    /** Notes added by services during the current request, merged into its entry by the middleware. */
    private static array $notes = [];

    /**
     * Records a command. $entry keys: module, action, operation (create|update|delete|read|system) are required; resource,
     * object_type, object_id, source (api|system|console|job), http_method, path, request_id, ip_address, user_agent,
     * request (field names only), context (reason, before/after summary), status (success|failed|blocked), http_status,
     * error, iam_account_id, iam_user_id are optional. Account and user default to the logged-in ones.
     *
     * Operations create/update/read follow the account's settings; delete and system are always recorded.
     */
    public static function record(array $entry): void
    {
        if (! config('commons.command_logs.enabled', true)) {
            return;
        }

        try {
            $entry = self::complete($entry);

            if (! self::isWanted($entry)) {
                return;
            }

            WriteCommandLogJob::dispatch($entry);
        } catch (Throwable $e) {
            Log::warning('[CommandLogs] could not record a command: '.$e->getMessage(), ['action' => $entry['action'] ?? null]);
        }
    }

    /**
     * During a request: say what the command was about. The middleware puts this on the row it writes for the request.
     * Several notes are merged; later values win. $context is merged key by key.
     */
    public static function note(?string $objectType, ?string $objectId, array $context = []): void
    {
        self::$notes = array_replace_recursive(self::$notes, array_filter([
            'object_type' => $objectType,
            'object_id' => $objectId,
            'context' => $context ?: null,
        ], fn ($v) => $v !== null));
    }

    /** Takes (and clears) the notes of the current request. Called by the middleware once the response is built. */
    public static function pullNotes(): array
    {
        $notes = self::$notes;
        self::$notes = [];

        return $notes;
    }

    /**
     * Inserts one history row. Called by WriteCommandLogJob; the actor has no role for this table, so the role check is
     * bypassed for this write only (the row is attributed to the account and user already inside $entry).
     */
    public static function store(array $entry): CommandLogs
    {
        return UserHelper::withRolesCheckBypassed(function () use ($entry) {
            $entry['created_at'] = $entry['created_at'] ?? now();

            return CommandLogs::create($entry);
        });
    }

    /**
     * Publishes a stored command to NATS so it can be followed live: the account's subject (customers' panel) and the platform
     * subject (internal live monitoring). Envelope is the platform's standard event protocol (docs/agents/protocol.md) with
     * payload.event "command" and payload.object the same shape GET /commons/command-logs returns.
     *
     * Best effort: the row is already stored, so a NATS problem is logged and never thrown (a thrown error would make the
     * queue retry the job and store the row twice).
     */
    public static function publish(CommandLogs $row): void
    {
        try {
            $config = (array) config('commons.command_logs.nats', []);

            if (empty($config['enabled']) || ! config('events.nats.enabled', false) || ! class_exists(\NextDeveloper\Events\Services\NatsService::class)) {
                return;
            }

            $account = $row->iam_account_id
                ? \NextDeveloper\IAM\Database\Models\Accounts::withoutGlobalScopes()->where('id', $row->iam_account_id)->first()
                : null;

            // Same output as the REST API, so the panel can use one parser for both
            $object = app(\NextDeveloper\Commons\Http\Transformers\CommandLogsTransformer::class)->transform($row);
            $object['account_id'] = $account?->uuid;

            $envelope = [
                'v' => 1,
                'id' => (string) \Illuminate\Support\Str::uuid(),
                'type' => 'event',
                'agent_type' => 'platform',
                'agent_uuid' => $account?->uuid,
                'timestamp' => time(),
                'payload' => [
                    'event' => 'command',
                    'object_type' => CommandLogs::class,
                    'object' => $object,
                ],
            ];

            $nats = app(\NextDeveloper\Events\Services\NatsService::class);

            // The acting user's own subject only, and only a reduced payload: ip address, user agent, request field names,
            // context (may hold before/after summaries) and error stay off the browser feed. System actions have no user and
            // go to the platform subject only.
            if (! empty($config['client_subject']) && $account && ! empty($object['iam_user_id'])) {
                $reduced = $envelope;
                $reduced['payload']['object'] = array_diff_key($object, array_flip(['ip_address', 'user_agent', 'request', 'context', 'error', 'request_id']));

                $nats->publish(
                    str_replace(['{account_uuid}', '{user_uuid}'], [$account->uuid, $object['iam_user_id']], $config['client_subject']),
                    $reduced
                );
            }

            if (! empty($config['platform_subject'])) {
                $nats->publish($config['platform_subject'], $envelope);
            }
        } catch (Throwable $e) {
            Log::warning('[CommandLogs] could not publish to NATS: '.$e->getMessage());
        }
    }

    /**
     * The list for GET /commons/command-logs (paginated when "paginate" is in the params, like the other Commons services).
     */
    public static function get(?CommandLogsQueryFilter $filter = null, array $params = []): Collection|LengthAwarePaginator
    {
        $filter ??= new CommandLogsQueryFilter(new Request());

        $perPage = (int) ($params['per_page'] ?? config('commons.pagination.per_page', 20)) ?: 20;

        // Newest first unless the caller chose an order
        if (array_key_exists('orderBy', $params)) {
            $filter->orderBy($params['orderBy']);
        }

        $query = CommandLogs::filter($filter);

        if (! array_key_exists('orderBy', $params)) {
            $query->orderByDesc('created_at');
        }

        if (array_key_exists('paginate', $params)) {
            $count = $query->count();
            $page = (int) ($params['page'] ?? 1);
            $items = $query->skip(($page - 1) * $perPage)->take($perPage)->get();

            return new LengthAwarePaginator($items, $count, $perPage, $page);
        }

        return $query->get();
    }

    /** One entry by uuid, within what the logged-in user may see. */
    public static function getByRef(string $ref): ?CommandLogs
    {
        return CommandLogs::where('uuid', $ref)->first();
    }

    /**
     * Removes rows older than the retention of their operation (commons.command_logs.retention_days). Operations with a null
     * retention (delete, system) are never touched. Works in chunks so a large backlog does not lock the table.
     *
     * @return array<string, int> rows removed (or counted when $dryRun) per operation
     */
    public static function prune(bool $dryRun = false): array
    {
        $result = [];

        foreach ((array) config('commons.command_logs.retention_days', []) as $operation => $days) {
            if ($days === null || ! in_array($operation, self::OPERATIONS, true) || in_array($operation, ['delete', 'system'], true)) {
                continue;
            }

            $query = CommandLogs::withoutGlobalScopes()
                ->where('operation', $operation)
                ->where('created_at', '<', now()->subDays((int) $days));

            if ($dryRun) {
                $result[$operation] = $query->count();
                continue;
            }

            $removed = 0;

            while (($ids = (clone $query)->limit(5000)->pluck('id'))->isNotEmpty()) {
                $removed += CommandLogs::withoutGlobalScopes()->whereIn('id', $ids)->delete();
            }

            $result[$operation] = $removed;
        }

        return $result;
    }

    /** Fills what the caller did not give: account and user of the current session, the current request. */
    private static function complete(array $entry): array
    {
        $entry['source'] = $entry['source'] ?? (app()->runningInConsole() ? 'console' : 'api');
        $entry['status'] = $entry['status'] ?? 'success';

        if (! array_key_exists('iam_account_id', $entry)) {
            $entry['iam_account_id'] = UserHelper::currentAccount()?->id;
        }

        if (! array_key_exists('iam_user_id', $entry)) {
            // Only a person is a user; system actions (source system/job/console) have none.
            $entry['iam_user_id'] = in_array($entry['source'], ['system', 'job', 'console'], true) ? null : UserHelper::me()?->id;
        }

        return $entry;
    }

    /** Applies the account's settings. delete and system always pass; everything is recorded when the account is unknown. */
    private static function isWanted(array $entry): bool
    {
        $operation = $entry['operation'] ?? null;

        if (! in_array($operation, self::OPERATIONS, true)) {
            return false;
        }

        if ($operation === 'delete' || $operation === 'system') {
            return true;
        }

        $accountId = $entry['iam_account_id'] ?? null;

        if (! $accountId) {
            return true;
        }

        $uuid = UserHelper::currentAccount()?->id === $accountId ? UserHelper::currentAccount()->uuid : null;

        return (bool) (CommandLogSettingsService::forAccount($accountId, $uuid)[$operation] ?? false);
    }
}
