<?php

namespace NextDeveloper\Commons\Pushers;

use NextDeveloper\Commons\Database\Models\PusherLogs;
use NextDeveloper\Commons\Database\Models\Pushers;

interface PusherInterface
{
    public function send(PusherLogs $log, Pushers $pusher): PusherResult;

    public static function provider(): string;
}
