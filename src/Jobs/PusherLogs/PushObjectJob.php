<?php

namespace NextDeveloper\Commons\Jobs\PusherLogs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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

        PusherFactory::make($pusher->provider)->execute($log, $pusher);
    }
}
