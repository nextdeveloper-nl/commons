<?php

namespace NextDeveloper\Commons\Services;

use Illuminate\Support\Facades\Log;
use NextDeveloper\Commons\Database\Models\PusherLogs;
use NextDeveloper\Commons\Database\Models\Pushers;
use NextDeveloper\Commons\Jobs\PusherLogs\PushObjectJob;
use NextDeveloper\Commons\Services\AbstractServices\AbstractPushersService;

/**
 * This class is responsible from managing the data for Pushers
 *
 * Class PushersService.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class PushersService extends AbstractPushersService
{

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

    /**
     * Queues a pusher delivery. Creates a PusherLog then explicitly dispatches
     * PushObjectJob — the job is NOT triggered by the log creation event.
     */
    public static function trigger(int $commonPusherId, array $payload): void
    {
        $pusher = Pushers::withoutGlobalScopes()
            ->where('id', $commonPusherId)
            ->first();

        if (!$pusher || !$pusher->url) {
            Log::warning('[PushersService::trigger] Pusher not found or has no URL', [
                'common_pusher_id' => $commonPusherId,
            ]);
            return;
        }

        // Disabled pushers (manually, or automatically after repeated permanent
        // failures) get no new logs until the owner fixes and re-enables them.
        if ($pusher->status === self::STATUS_DISABLED) {
            Log::info('[PushersService::trigger] Pusher is disabled — skipping', [
                'common_pusher_id' => $commonPusherId,
            ]);
            return;
        }

        $log = PusherLogsService::create([
            'common_pusher_id' => $pusher->id,
            'body'             => $payload,
            'status'           => 'pending',
        ]);

        PushObjectJob::dispatch($log)->onQueue('pushers');
    }

    public static function create(array $data)
    {
        $data = self::resolveBaseUrl($data);

        return parent::create($data);
    }

    public static function update($id, array $data)
    {
        $data = self::resolveBaseUrl($data);
        $data = self::applyStatusChange($data);

        return parent::update($id, $data);
    }

    public const STATUS_ACTIVE   = 'active';
    public const STATUS_DISABLED = 'disabled';

    /**
     * Response codes that mean the endpoint is gone (404/410) or the credentials
     * are rejected (401/403). Retrying will not help; the owner has to fix the
     * pusher. 429, 5xx and timeouts are transient and never count.
     */
    public const AUTO_DISABLE_STATUS_CODES = [401, 403, 404, 410];

    /**
     * How many consecutive permanent failures disable a pusher, so a single bad
     * moment does not switch off a working integration.
     */
    public const AUTO_DISABLE_AFTER_FAILURES = 5;

    /**
     * Called by AbstractPusher after a failed push from a driver that supports
     * auto-disable (external HTTP endpoints only). Disables the pusher and emails
     * its owner when its last AUTO_DISABLE_AFTER_FAILURES executed logs all failed
     * with a permanent response code.
     */
    public static function handleFailedPush(Pushers $pusher, ?int $responseCode, ?string $responseBody): void
    {
        if ($pusher->status === self::STATUS_DISABLED) {
            return;
        }

        if (!in_array($responseCode, self::AUTO_DISABLE_STATUS_CODES, true)) {
            return;
        }

        // Only logs executed since the pusher was last changed count, so fixing the
        // URL (or re-enabling it) starts the count over.
        $recentCodes = PusherLogs::withoutGlobalScopes()
            ->where('common_pusher_id', $pusher->id)
            ->whereIn('status', ['completed', 'failed'])
            ->whereNull('deleted_at')
            ->where('updated_at', '>=', $pusher->updated_at)
            ->orderByDesc('updated_at')
            ->limit(self::AUTO_DISABLE_AFTER_FAILURES)
            ->pluck('response_code')
            ->map(fn ($code) => $code === null ? null : (int) $code);

        if ($recentCodes->count() < self::AUTO_DISABLE_AFTER_FAILURES) {
            return;
        }

        foreach ($recentCodes as $code) {
            if (!in_array($code, self::AUTO_DISABLE_STATUS_CODES, true)) {
                return;
            }
        }

        $reason = 'Automatically disabled after ' . self::AUTO_DISABLE_AFTER_FAILURES
            . ' consecutive failed pushes (last response: HTTP ' . $responseCode . ').';

        self::disable($pusher, $reason, $responseBody);
    }

    /**
     * Disables the pusher and emails its owner once.
     */
    public static function disable(Pushers $pusher, string $reason, ?string $lastResponse = null): Pushers
    {
        $pusher = self::update($pusher->uuid, [
            'status'          => self::STATUS_DISABLED,
            'disabled_reason' => $reason,
        ]);

        Log::warning('[PushersService::disable] Pusher disabled', [
            'common_pusher_id' => $pusher->id,
            'reason'           => $reason,
        ]);

        self::notifyOwnerOfDisable($pusher, $reason, $lastResponse);

        return $pusher;
    }

    /**
     * Re-enables a disabled pusher. Also happens when the pusher is updated with
     * status = active (e.g. from the UI after fixing the URL).
     */
    public static function enable(Pushers $pusher): Pushers
    {
        return self::update($pusher->uuid, ['status' => self::STATUS_ACTIVE]);
    }

    /**
     * Keeps disabled_at / disabled_reason consistent with status on every update:
     * disabling stamps disabled_at, re-enabling clears both fields.
     */
    private static function applyStatusChange(array $data): array
    {
        if (!array_key_exists('status', $data)) {
            return $data;
        }

        if ($data['status'] === self::STATUS_DISABLED) {
            $data['disabled_at']     = $data['disabled_at'] ?? now();
            $data['disabled_reason'] = $data['disabled_reason'] ?? 'Disabled manually.';
        } else {
            $data['status']          = self::STATUS_ACTIVE;
            $data['disabled_at']     = null;
            $data['disabled_reason'] = null;
        }

        return $data;
    }

    /**
     * Emails the pusher's owner (its iam_user_id, falling back to the account owner).
     * Uses the IAM Users model's sendEmail() so Commons does not depend on
     * Communication directly. Never throws: failing to notify must not break the push.
     */
    private static function notifyOwnerOfDisable(Pushers $pusher, string $reason, ?string $lastResponse): void
    {
        try {
            $usersClass    = '\NextDeveloper\IAM\Database\Models\Users';
            $accountsClass = '\NextDeveloper\IAM\Database\Models\Accounts';

            $ownerId = $pusher->iam_user_id;

            if (!$ownerId && $pusher->iam_account_id) {
                $ownerId = $accountsClass::withoutGlobalScopes()->where('id', $pusher->iam_account_id)->value('iam_user_id');
            }

            $owner = $ownerId ? $usersClass::withoutGlobalScopes()->where('id', $ownerId)->first() : null;

            if (!$owner || !$owner->email || !method_exists($owner, 'sendEmail')) {
                Log::warning('[PushersService::notifyOwnerOfDisable] No owner to notify', [
                    'common_pusher_id' => $pusher->id,
                ]);
                return;
            }

            $e = fn ($value) => htmlspecialchars((string) $value, ENT_QUOTES);

            $body = '<p>Your integration <strong>' . $e($pusher->name) . '</strong> has been disabled.</p>'
                . '<p><strong>Reason:</strong> ' . $e($reason) . '</p>'
                . '<p><strong>Endpoint:</strong> ' . $e(strtoupper($pusher->method ?? 'POST')) . ' ' . $e($pusher->url) . '</p>'
                . ($lastResponse ? '<p><strong>Last response:</strong><br><code>' . $e(mb_substr($lastResponse, 0, 1000)) . '</code></p>' : '')
                . '<p>No further data will be sent to this endpoint until you fix it and re-enable the integration.</p>';

            $owner->sendEmail('Integration "' . $pusher->name . '" has been disabled', $body);
        } catch (\Throwable $ex) {
            Log::error('[PushersService::notifyOwnerOfDisable] Failed to notify owner', [
                'common_pusher_id' => $pusher->id,
                'error'            => $ex->getMessage(),
            ]);
        }
    }

    // If provider_metadata contains {{base_url}} and a workflow_id, look up the
    // workflow in ipaas_workflows, fetch its provider, and substitute the real base_url.
    // Uses class_exists so commons stays decoupled from ipaas.
    private static function resolveBaseUrl(array $data): array
    {
        $url      = $data['url'] ?? null;
        $metadata = $data['provider_metadata'] ?? null;

        if (!$url || !str_contains($url, '{{base_url}}')) {
            return $data;
        }

        $workflowId = is_array($metadata) ? ($metadata['workflow_id'] ?? null) : null;

        if (!$workflowId) {
            return $data;
        }

        $workflowClass = '\NextDeveloper\IPAAS\Database\Models\Workflows';
        $providerClass = '\NextDeveloper\IPAAS\Database\Models\Providers';

        if (!class_exists($workflowClass) || !class_exists($providerClass)) {
            return $data;
        }

        $workflow = $workflowClass::where('uuid', $workflowId)->first();

        if (!$workflow) {
            return $data;
        }

        $provider = $providerClass::where('id', $workflow->ipaas_provider_id)->first();

        if (!$provider || !$provider->base_url) {
            return $data;
        }

        $data['url'] = str_replace('{{base_url}}', rtrim($provider->base_url, '/'), $url);

        return $data;
    }
}
