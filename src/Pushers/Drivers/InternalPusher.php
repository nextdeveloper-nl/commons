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

    /**
     * Self-description used by GET /commons/pushers/providers.
     */
    public static function definition(): array
    {
        return array_merge(parent::definition(), [
            'label'           => 'Internal',
            'description'     => 'Placeholder for internal delivery; not yet implemented.',
            'is_internal'     => true,
            'requires_url'    => false,
            'requires_token'  => false,
            'supports_auth'   => false,
        ]);
    }

    public function send(PusherLogs $log, Pushers $pusher): PusherResult
    {
        // Placeholder — internal delivery is not yet implemented.
        return PusherResult::ok(200, 'Internal pusher not yet implemented.');
    }


}
