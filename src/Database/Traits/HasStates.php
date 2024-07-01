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

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use NextDeveloper\Commons\Database\Models\States;
use  NextDeveloper\Commons\Exceptions\InvalidState;
use NextDeveloper\IAM\Database\Scopes\AuthorizationScope;

/**
 * Trait HasStates
 * @package  NextDeveloper\Commons\Database\Traits
 */
trait HasStates
{

    /**
     * @var bool
     */
    protected $overwriteState = false;

    /**
     * @param bool $overwrite
     *
     * @return $this
     */
    public function setOverwriteState($overwrite) {
        $this->overwriteState = (bool) $overwrite;

        return $this;
    }

    /**
     * @return mixed
     */
    public function states() {
        return $this->morphMany(
            $this->getStateModelClassName(), 'model', 'model_type', $this->getModelKeyColumnName()
        )->latest( 'id' );
    }

    /**
     * @return mixed
     */
    public function state() {
        return $this->latestState();
    }

    /**
     * @param $name
     * @param null $value
     * @param null $reason
     * @param bool $overwrite
     *
     * @return HasStates
     * @throws InvalidState
     */
    public function setState($name, $value = null, $reason = null, $overwrite = false) {
        trigger_error( 'This method is not implemented yet');
    }

    /**
     * @param null $names
     *
     * @return mixed
     */
    public function latestState($names = null) {
        trigger_error( 'This method is not implemented yet');
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function hasEverHadState($name) {
        trigger_error( 'This method is not implemented yet');
    }

    /**
     * @param null $names
     *
     * @return $this
     */
    public function deleteState($names = null) {
        trigger_error( 'This method is not implemented yet');
    }

    /**
     * @return string
     */
    public function getStateAttribute() {
        trigger_error( 'This method is not implemented yet');
    }

    /**
     * @return mixed
     */
    protected function getStateTableName() {
        $modelClass = $this->getStateModelClassName();

        return ( new $modelClass )->getTable();
    }

    /**
     * @return string
     */
    protected function getModelKeyColumnName() {
        return 'model_id';
    }

    /**
     * @return string
     */
    protected function getStateModelClassName() {
        return \NextDeveloper\Commons\Database\Models\States::class;
    }

    /**
     * @return string
     */
    protected function getStateModelType() {
        return array_search( static::class, Relation::morphMap() ) ?: static::class;
    }
}
