<?php
/**
 * This file was part of the PlusClouds.Core library but now its migrated to
 * NextDeveloper.Commons
 *
 * (c) Semih Turna <semih.turna@plusclouds.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NextDeveloper\Commons\Database\Traits;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

/**
 * Trait UuidId.
 *
 * @package  NextDeveloper\Commons\Database\Traits
 */
trait UuidId {
    /**
     * @return string
     */
    public static function getHashidsColumn() {
        return 'uuid';
    }

    /**
     * @param $ref
     *
     * @throws ModelNotFoundException
     *
     * @return mixed
     */
    public static function findByRef($ref) {
        if ( ! is_null($data = static::whereRaw(static::getHashidsColumn().' = ?', [$ref])->first())) {
            return $data;
        }

        $className = str_replace('_', ' ', Str::snake(Str::camel(class_basename(static::class))));

        $message = sprintf('Could not find any %s', $className);

        throw new ModelNotFoundException($message);
    }

    /**
     * @param $ref
     */
    public static function findByUuid($ref) {
        return static::findByRef($ref);
    }

    /**
     * @param $query
     * @param $ref
     *
     * @return mixed
     */
    public function scopeByRef($query, $ref) {
        return $query->whereRaw(static::getHashidsColumn().' COLLATE utf8_bin = ?', [$ref]);
    }

    /**
     * @param $query
     * @param $ref
     */
    public function scopeByUuid($query, $ref) {
        return $this->scopeByRef($query, $ref);
    }
}
