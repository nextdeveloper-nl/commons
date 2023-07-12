<?php

namespace NextDeveloper\Commons\Events\Country;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\Country;

/**
 * Class CountryRestoredEvent
 * @package NextDeveloper\Commons\Events
 */
class CountryRestoredEvent
{
    use SerializesModels;

    /**
     * @var Country
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(Country $model = null) {
        $this->_model = $model;
    }

    /**
    * @param int $value
    *
    * @return AbstractEvent
    */
    public function setTimestamp($value) {
        $this->timestamp = $value;

        return $this;
    }

    /**
    * @return int|null
    */
    public function getTimestamp() {
        return $this->timestamp;
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}