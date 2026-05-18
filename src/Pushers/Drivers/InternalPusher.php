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
        /**
         * TODO: Implement internal pusher logic here. This is just a placeholder for the actual implementation.
         * You can use the $log and $pusher objects to access the necessary data for sending the push notification.
         * After implementing the logic, you can return a PusherResult object with the appropriate status and message.
         * Example:
         * $result = new PusherResult();
         * $result->status = 'success';
         * $result->message = 'Push notification sent successfully.';
         * return $result;
         */
        $result = new PusherResult();
        $result->status = 'success';
        $result->message = 'Push notification sent successfully.';
        return $result;
    }


}
