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

use Illuminate\Database\Eloquent\Relations\Relation;
use NextDeveloper\Commons\Exceptions\InvalidState;

/**
 * Trait HasStates
 * @package  NextDeveloper\Commons\Database\Traits
 */
trait HasObject
{
    /**
     * Returns the object that is linked to the state
     *
     * @return Relation
     * @throws InvalidState
     */
    public function getObject()
    {
        $type = $this->object_type;

        if (class_exists($type)) {
            return (new $type)::find($this->object_id);
        }

        return null;
    }

    public function setObject($object)
    {
        $this->object_type = get_class($object);
        $this->object_id = $object->id;
    }
}
