<?php

namespace NextDeveloper\Commons\Pushers;

use NextDeveloper\Commons\Pushers\Drivers\DefaultHttpPusher;
use NextDeveloper\Commons\Pushers\Drivers\InternalPusher;
use NextDeveloper\Commons\Pushers\Drivers\LeadGenPusher;
use NextDeveloper\Commons\Pushers\Drivers\WebhookPusher;
use NextDeveloper\Commons\Pushers\PusherInterface;

class PusherFactory
{
    public const DEFAULT_PROVIDER = 'default';

    /** @var array<string, class-string<PusherInterface>> */
    protected static array $drivers = [
        'default'  => DefaultHttpPusher::class,
        'webhook'  => WebhookPusher::class,
        'leadgen'  => LeadGenPusher::class,
        'internal' => InternalPusher::class,
    ];

    public static function make(?string $provider): PusherInterface
    {
        $key = $provider ?: self::DEFAULT_PROVIDER;
        $class = self::$drivers[$key] ?? self::$drivers[self::DEFAULT_PROVIDER];

        return new $class();
    }

    /**
     * @param class-string<PusherInterface> $class
     */
    public static function register(string $provider, string $class): void
    {
        self::$drivers[$provider] = $class;
    }

    /**
     * @return array<string, class-string<PusherInterface>>
     */
    public static function drivers(): array
    {
        return self::$drivers;
    }
}
