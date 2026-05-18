<?php

namespace NextDeveloper\Commons\Pushers\Drivers;

use NextDeveloper\Commons\Database\Models\PusherLogs;
use NextDeveloper\Commons\Database\Models\Pushers;
use NextDeveloper\Commons\Pushers\AbstractPusher;
use NextDeveloper\Commons\Pushers\PusherResult;

class InternalPusher extends AbstractPusher
{
    public static function provider(): string
    {
        return 'internal';
    }

    public function send(PusherLogs $log, Pushers $pusher): PusherResult
    {
        // Placeholder — internal delivery is not yet implemented.
        return PusherResult::ok(200, 'Internal pusher not yet implemented.');
    }


}
