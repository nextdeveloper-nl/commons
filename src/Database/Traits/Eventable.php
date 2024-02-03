<?php
/**
 * This file is part of the PlusClouds.Core library.
 *
 * (c) Semih Turna <semih.turna@plusclouds.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NextDeveloper\Commons\Database\Traits;

use App\Services\Events;
use NextDeveloper\Commons\Database\Filters\AbstractQueryFilter;

/**
 * Trait Filterable
 * @package PlusClouds\Core\Database\Traits
 */
trait Eventable
{
    public static function bootEventable(){
        static::creating(function($model){
            $model->fireModelEvent('creating');
        });

        static::created(function($model){
            Events::fire(class_basename($model), [
                'uuid'  =>  $model->uuid
            ]);

            $model->fireModelEvent('created');
        });

        static::updating(function($model){
            $model->fireModelEvent('updating');
        });

        static::updated(function($model){
            $model->fireModelEvent('updated');
        });

        static::deleting(function($model){
            $model->fireModelEvent('deleting');
        });

        static::deleted(function($model){
            $model->fireModelEvent('deleted');
        });

        static::saving(function($model){
            Events::fire(class_basename($model), [
                'uuid'  =>  $model->uuid
            ]);

            $model->fireModelEvent('saving');
        });

        static::saved(function($model){
            Events::fire(class_basename($model), [
                'uuid'  =>  $model->uuid
            ]);

            $model->fireModelEvent('saved');
        });
    }
}
