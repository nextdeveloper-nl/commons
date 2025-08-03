<?php

namespace NextDeveloper\Commons\Common\Cache\Traits;


use NextDeveloper\Commons\Common\Cache\CacheHelper;

/**
 * This trait works with the model object and when update or delete happens it removes all the information
 * about this object from the cache
 */
trait CleanCache
{
    public static function bootCleanCache() {
        static::updating(function ($model) {
            $explodedModel = explode('\\', get_class($model));
            CacheHelper::deleteKeys($explodedModel[count($explodedModel) - 1], $model->uuid);
        });

        static::updated(function ($model) {
            $explodedModel = explode('\\', get_class($model));
            CacheHelper::deleteKeys($explodedModel[count($explodedModel) - 1], $model->uuid);
        });

        static::deleted(function ($model) {
            $explodedModel = explode('\\', get_class($model));
            CacheHelper::deleteKeys($explodedModel[count($explodedModel) - 1], $model->uuid);
        });
    }
}
