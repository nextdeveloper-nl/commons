<?php

namespace NextDeveloper\Commons\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DatabaseHelper
{
    /**
     * Return true if the column exists. But this function uses cache, so be careful!
     *
     * @param $min
     * @param $max
     * @return string
     */
    public static function isColumnExists($table, $column, $refresh = false) : bool
    {
        if(Cache::has('table_' . $table . '_has_column_' . $column) && !$refresh) {
            return Cache::get('table_' . $table . '_has_column_' . $column);
        }

        $hasColumn = Schema::hasColumn($table, $column);

        //  Caching forever (no TTL) let stale results survive schema changes indefinitely on drivers
        //  like Redis that persist across deploys. Using a TTL lets it self-heal.
        Cache::put('table_' . $table . '_has_column_' . $column, $hasColumn, now()->addHour());

        return $hasColumn;
    }

    public static function uuidToId($obj, $uuid) {
        if(is_int($uuid))
            return $uuid;

        $isUuid = Str::isUuid($uuid);

        if($isUuid) {
            $obj = $obj::findByUuid($uuid);

            if($obj)
                return $obj->id;
		}

        return null;
    }
}
