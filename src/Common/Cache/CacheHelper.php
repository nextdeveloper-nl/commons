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
                break;
        }

        return true;
    }

    private static function deleteRedisKeys($obj, $id) {
        $config = config('database.redis.cache');
        $r = new \Redis();
        $r->connect($config['host'], $config['port']);
        $r->auth(env('REDIS_PASSWORD'));
        $r->select(1);

        $it = null;

        while( $it !== 0 ) {
            foreach ( $r->scan($it, '*' . self::getKey($obj, $id) . '*') as $k) {
                $r->del($k);
            }
        }
    }
}
