<?php

namespace NextDeveloper\Commons\Pushers;

use NextDeveloper\Commons\Pushers\Drivers\DefaultHttpPusher;
use NextDeveloper\Commons\Pushers\Drivers\InternalPusher;
use NextDeveloper\Commons\Pushers\Drivers\LeadGenPusher;
use NextDeveloper\Commons\Pushers\Drivers\N8NPusher;
use NextDeveloper\Commons\Pushers\PusherInterface;

class PusherFactory
{
    public const DEFAULT_PROVIDER = 'default';

    /** @var array<string, class-string<PusherInterface>> */
    protected static array $drivers = [
        'default'  => DefaultHttpPusher::class,
        'n8n'      => N8NPusher::class,
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
     * Object (model class) list a provider supports; empty means any object.
     *
     * @return array<int, class-string>
     */
    public static function supportedObjects(?string $provider): array
    {
        $class = self::$drivers[$provider ?: self::DEFAULT_PROVIDER] ?? self::$drivers[self::DEFAULT_PROVIDER];

        return $class::supportedObjects();
    }

    /**
     * Provider keys that can handle the given model class (specific match or generic).
     *
     * @return array<int, string>
     */
    public static function providersForObject(string $objectType): array
    {
        $objectType = ltrim($objectType, '\\');

        return array_keys(array_filter(
            self::$drivers,
            function ($class) use ($objectType) {
                $supported = $class::supportedObjects();

                return empty($supported) || in_array($objectType, $supported, true);
            }
        ));
    }

    /**
     * @return array<string, class-string<PusherInterface>>
     */
    public static function drivers(): array
    {
        return self::$drivers;
    }
}
