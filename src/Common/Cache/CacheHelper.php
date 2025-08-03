<?php

namespace NextDeveloper\Commons\Common\Cache;

use Illuminate\Support\Facades\Cache;

class CacheHelper
{
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
     * Deletes all the cached keys of the related
     *
     * @param $obj
     * @param $id
     * @return bool
     */
    public static function deleteKeys($obj, $id) : bool
    {
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
            // Scanning through the keys that match the pattern
            foreach ( $r->scan($it, '*' . self::getKey($obj, $id) . '*') as $k) {
                $r->del($k);
            }
        }
    }
}
