<?php

namespace NextDeveloper\Commons\Services;

use Illuminate\Support\Facades\Log;
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

        return parent::update($id, $data);
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
