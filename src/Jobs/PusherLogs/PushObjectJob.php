<?php

namespace NextDeveloper\Commons\Jobs\PusherLogs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use NextDeveloper\Commons\Database\Models\PusherLogs;
use NextDeveloper\Commons\Database\Models\Pushers;
use NextDeveloper\Commons\Pushers\PusherFactory;
use NextDeveloper\Commons\Services\PusherLogsService;
use NextDeveloper\Commons\Services\PushersService;
use NextDeveloper\IAM\Database\Scopes\AuthorizationScope;
use NextDeveloper\IAM\Helpers\UserHelper;

class PushObjectJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public const QUEUE_NAME = 'commons';

    /**
     * Log status of a push whose internal driver is not registered in the application that picked the job up.
     * The log waits for an application that has the driver (nextdeveloper:run-deferred-pushers).
     */
    public const STATUS_DEFERRED = 'deferred';

    public int $tries = 3;

    public int $timeout = 60;

    public function __construct(public PusherLogs $model, public array $payload = [])
    {
        $this->queue = self::QUEUE_NAME;
    }

    public function handle(): void
    {
        $log = PusherLogs::withoutGlobalScope(AuthorizationScope::class)
            ->where('id', $this->model->id)
            ->first();

        if (!$log || $log->status !== 'pending') {
            return;
        }

        $pusher = Pushers::withoutGlobalScope(AuthorizationScope::class)
            ->where('id', $log->common_pusher_id)
            ->first();

        if (!$pusher) {
            return;
        }

        // Logs queued before the pusher was disabled are closed instead of sent,
        // so they do not sit in 'pending' forever.
        if ($pusher->status === PushersService::STATUS_DISABLED) {
            UserHelper::runAsAdmin(function () use ($log) {
                PusherLogsService::update($log->uuid, [
                    'status'        => 'failed',
                    'response_body' => 'Skipped: pusher is disabled.',
                ]);
            });

            return;
        }

        // An internal driver this application does not have must never fall back to the default HTTP
        // driver: its url is a placeholder ("internal://..."), so the request can only fail.
        if (!PusherFactory::isRegistered($pusher->provider) && PusherFactory::isInternalUrl($pusher->url)) {
            $this->defer($log, $pusher);

            return;
        }

        PusherFactory::make($pusher->provider)->execute($log, $pusher);
    }

    /**
     * Parks the log for an application that has the driver, instead of sending it.
     */
    private function defer(PusherLogs $log, Pushers $pusher): void
    {
        PusherLogs::withoutGlobalScopes()
            ->where('id', $log->id)
            ->where('status', 'pending')
            ->update([
                'status'        => self::STATUS_DEFERRED,
                'response_body' => json_encode(
                    'Deferred: the "' . $pusher->provider . '" driver is not registered in this application. '
                    . 'Waiting for an application that has it.'
                ),
            ]);

        Log::info('[PushObjectJob] Internal driver not registered here, push deferred', [
            'provider'      => $pusher->provider,
            'pusher_log_id' => $log->id,
        ]);
    }
}
