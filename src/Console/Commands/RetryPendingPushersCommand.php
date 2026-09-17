<?php
namespace NextDeveloper\Commons\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use NextDeveloper\Commons\Database\Models\PusherLogs;
use NextDeveloper\Commons\Database\Models\Pushers;
use NextDeveloper\Commons\Services\PusherLogsService;

/**
 * Class RetryPendingPushersCommand
 *
 * Finds push logs that are stuck "pending" (never picked up by a worker) or
 * "failed", and re-queues them - but only for Pushers that have retry
 * explicitly enabled, and only up to the configured max attempts.
 */
class RetryPendingPushersCommand extends Command
{
    protected $signature = 'nextdeveloper:retry-pending-pushers';

    protected $description = 'Re-queues stuck pending / failed pusher logs for Pushers that have retry enabled.';

    public function handle(): void
    {
        $staleAfterMinutes = config('commons.pusher.stale_after_minutes', 15);
        $maxRetries = config('commons.pusher.max_retries', 5);

        $retryablePusherIds = Pushers::withoutGlobalScopes()
            ->where('is_retryable', true)
            ->pluck('id');

        if ($retryablePusherIds->isEmpty()) {
            $this->line('No pushers have retry enabled, nothing to do.');
            return;
        }

        $logs = PusherLogs::withoutGlobalScopes()
            ->whereIn('common_pusher_id', $retryablePusherIds)
            ->whereIn('status', ['pending', 'failed'])
            ->where('updated_at', '<=', now()->subMinutes($staleAfterMinutes))
            ->where('retry_count', '<', $maxRetries)
            ->get();

        $this->line("Found {$logs->count()} pusher log(s) to retry.");

        foreach ($logs as $log) {
            try {
                PusherLogsService::retry($log->uuid);
            } catch (\Throwable $e) {
                Log::error('[RetryPendingPushersCommand] Failed to retry pusher log', [
                    'pusher_log_id' => $log->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }
}
