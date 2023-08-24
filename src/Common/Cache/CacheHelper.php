<?php

namespace NextDeveloper\Commons\Common\Cache;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

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

    }
}