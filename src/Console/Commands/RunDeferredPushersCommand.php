<?php
namespace NextDeveloper\Commons\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use NextDeveloper\Commons\Database\Models\PusherLogs;
use NextDeveloper\Commons\Database\Models\Pushers;
use NextDeveloper\Commons\Jobs\PusherLogs\PushObjectJob;
use NextDeveloper\Commons\Pushers\PusherFactory;

/**
 * Class RunDeferredPushersCommand
 *
 * Pusher drivers are registered per application, while pushers and their logs are shared. When a push is
 * created in an application that does not have the pusher's internal driver, PushObjectJob parks the log as
 * "deferred" instead of sending it. This command, scheduled in the application that has the driver, runs those
 * logs. It runs them in this process rather than on the queue, because a queued job could be picked up again
 * by a worker of an application without the driver.
 */
class RunDeferredPushersCommand extends Command
{
    protected $signature = 'nextdeveloper:run-deferred-pushers';

    protected $description = 'Runs deferred pusher logs whose driver is registered in this application.';

    public function handle(): void
    {
        $pusherIds = Pushers::withoutGlobalScopes()
            ->whereNull('deleted_at')
            ->whereIn('provider', array_keys(PusherFactory::drivers()))
            ->pluck('id');

        if ($pusherIds->isEmpty()) {
            $this->line('No pushers with a registered driver, nothing to do.');

            return;
        }

        $logs = PusherLogs::withoutGlobalScopes()
            ->whereNull('deleted_at')
            ->whereIn('common_pusher_id', $pusherIds)
            ->where('status', PushObjectJob::STATUS_DEFERRED)
            ->orderBy('id')
            ->limit((int) config('commons.pusher.deferred_batch_size', 100))
            ->get();

        $this->line("Found {$logs->count()} deferred pusher log(s) to run.");

        foreach ($logs as $log) {
            if (! $this->claim($log)) {
                continue;
            }

            try {
                (new PushObjectJob($log))->handle();
            } catch (\Throwable $e) {
                Log::error('[RunDeferredPushersCommand] Failed to run deferred pusher log', [
                    'pusher_log_id' => $log->id,
                    'error'         => $e->getMessage(),
                ]);
            }
        }
    }

    /**
     * Moves the log back to "pending" so the job accepts it. False when another run already took it.
     */
    private function claim(PusherLogs $log): bool
    {
        return PusherLogs::withoutGlobalScopes()
            ->where('id', $log->id)
            ->where('status', PushObjectJob::STATUS_DEFERRED)
            ->update(['status' => 'pending', 'response_body' => null]) === 1;
    }
}
