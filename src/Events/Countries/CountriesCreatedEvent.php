<?php

namespace NextDeveloper\Commons\Events\Countries;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\Country;

/**
 * Class CountriesCreatedEvent
 * @package NextDeveloper\Commons\Events
 */
class CountriesCreatedEvent
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
}