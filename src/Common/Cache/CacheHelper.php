<?php

namespace NextDeveloper\Commons\Common\Cache;

use Illuminate\Support\Facades\Cache;

class CacheHelper
{
    /**
     * The variant a model's transformer output is cached under.
     */
    public const TRANSFORMED = 'Transformed';

    /**
     *
     *
     * @param $app string name of the application that needs cache
     * @param $id object the model we need the
     * @return string
     */
    public static function getKey($obj, $id, $variant = null) : string
    {
        $key = $obj . ':' . $id;

        if($variant)
            $key .= ':' . $variant;

        return $key;
    }

    /**
     * The transformer output of a model, from the cache or made by $transform and cached.
     *
     * The value is cached as plain data, the way it is rendered to the client: a date is its
     * ISO 8601 string rather than a Carbon object. A cache hit therefore renders exactly like a
     * miss, and does not depend on the classes the cache store is allowed to unserialize
     * (Laravel 12+ allows none by default, which turned cached dates into
     * __PHP_Incomplete_Class objects).
     *
     * The entry lives commons.cache.transformed_ttl seconds. Writes through the model events
     * invalidate it at once (CleanCache); the expiry bounds how long a change that bypasses
     * them stays invisible - updateQuietly(), a query builder update, a trigger, or a row a
     * perspective view joins.
     *
     * @param string $obj The short class name of the model, as the keys are written
     * @param string|null $uuid
     * @param callable(): array $transform
     * @return array
     */
    public static function rememberTransformed(string $obj, ?string $uuid, callable $transform) : array
    {
        //  A row without a uuid has no key of its own; caching it would share one entry across rows.
        if(!$uuid)
            return json_decode(json_encode($transform()), true) ?? [];

        $key = self::getKey($obj, $uuid, self::TRANSFORMED);

        $transformed = Cache::get($key);

        if(is_array($transformed))
            return $transformed;

        $transformed = $transform();

        $plain = json_decode(json_encode($transformed), true);

        //  Not representable as JSON (for example invalid UTF-8): serve it, but do not cache it.
        if(!is_array($plain))
            return $transformed;

        Cache::put($key, $plain, (int) config('commons.cache.transformed_ttl', 3600));

        return $plain;
    }

    /**
     * Deletes all the cached keys of a model and of its perspective.
     *
     * The keys are written with the model's short class name. A fully qualified name - what
     * get_class($model) and Model::class give - is reduced to it; passed as is, it used to
     * match no key at all.
     *
     * Only redis can be scanned for every variant. On the other stores the transformer cache,
     * the variant every model has, is still forgotten, so invalidation also works on the file
     * and array stores of development machines and tests.
     *
     * @param $obj
     * @param $id
     * @return bool
     */
    public static function deleteKeys($obj, $id) : bool
    {
        $obj = class_basename($obj);

        Cache::forget(self::getKey($obj, $id, self::TRANSFORMED));
        Cache::forget(self::getKey($obj . 'Perspective', $id, self::TRANSFORMED));

        $store = Cache::getDefaultDriver();

        switch ($store) {
            case 'redis':
                self::deleteRedisKeys($obj, $id);
                self::deleteRedisKeys($obj . 'Perspective', $id);
                break;
        }

        return true;
    }

    private static function deleteRedisKeys($obj, $id) {
        $config = config('database.redis.cache');

        $r = new \Redis();
        $r->pconnect($config['host'], $config['port'], 0,null, 0, 0, [
            'auth'  =>  config('database.redis.cache.password')
        ]);
        $r->select(config('database.redis.cache.database'));

        $it = null;

        while( $it !== 0 ) {
            //  Sample pattern is like this;
            //  'Partnership:1' and 'PartnershipPerspective:1' (the short class name, see deleteKeys)

            //  COUNT is raised from the phpredis default (10) to cut down the number of round trips
            //  needed to walk the whole keyspace - on a large cache DB the default was slow enough
            //  to blow past the queue worker timeout during cache invalidation.
            // Scanning through the keys that match the pattern
            foreach ( $r->scan($it, '*' . self::getKey($obj, $id) . '*', 1000) ?: [] as $k) {
                $r->del($k);
            }
        }
    }
}
