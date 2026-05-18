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
use NextDeveloper\IAM\Database\Scopes\AuthorizationScope;

class PushObjectJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public const EVENTS = [
        'created:NextDeveloper\Commons\PusherLogs',
    ];

    public const QUEUE_NAME = 'commons';

    public int $tries = 3;

    public int $timeout = 60;

    public function __construct(public PusherLogs $model)
    {
        $this->queue = self::QUEUE_NAME;
    }

    public function handle(): void
    {
        $pusher = Pushers::withoutGlobalScope(AuthorizationScope::class)
            ->where('id', $this->model->common_pusher_id)
            ->first();

        if (!$pusher) {
            return;
        }

        PusherFactory::make($pusher->provider)->execute($this->model, $pusher);
    }
}
