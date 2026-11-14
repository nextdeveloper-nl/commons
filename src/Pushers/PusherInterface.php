<?php

namespace NextDeveloper\Commons\Pushers;

use NextDeveloper\Commons\Database\Models\PusherLogs;
use NextDeveloper\Commons\Database\Models\Pushers;

interface PusherInterface
{
    public function send(PusherLogs $log, Pushers $pusher): PusherResult;

    public static function provider(): string;

    /**
     * Full model classes this driver can handle. Empty array means the driver is
     * generic (accepts any object). Used by the UI to filter pushers by object.
     *
     * @return array<int, class-string>
     */
    public static function supportedObjects(): array;

    /**
     * Self-description of the driver (label, description, supported objects, required
     * fields, metadata fields). Served by GET /commons/pushers/providers for the UI.
     *
     * @return array<string, mixed>
     */
    public static function definition(): array;
}
