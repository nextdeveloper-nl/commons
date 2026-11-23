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
     * Whether this application has a driver for the provider. An empty provider is the default HTTP driver.
     * Drivers are registered per application, so a provider known to one app can be unknown to another
     * app that shares the same pushers.
     */
    public static function isRegistered(?string $provider): bool
    {
        return ! $provider || isset(self::$drivers[$provider]);
    }

    /**
     * Whether the pusher url is the "internal:" placeholder that internal drivers use instead of a real endpoint.
     */
    public static function isInternalUrl(?string $url): bool
    {
        return str_starts_with(strtolower(trim((string) $url)), 'internal:');
    }

    /**
     * @param class-string<PusherInterface> $class
     */
    public static function register(string $provider, string $class): void
    {
        self::$drivers[$provider] = $class;
    }

    /**
     * Lets the provider's driver validate provider_metadata (throws ValidationException to reject).
     */
    public static function validateMetadata(?string $provider, ?array $metadata): void
    {
        if ($metadata === null) {
            return;
        }

        $class = self::$drivers[$provider ?: self::DEFAULT_PROVIDER] ?? self::$drivers[self::DEFAULT_PROVIDER];

        if (method_exists($class, 'validateProviderMetadata')) {
            $class::validateProviderMetadata($metadata);
        }
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
