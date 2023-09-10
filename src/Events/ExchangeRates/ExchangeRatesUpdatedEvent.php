<?php

namespace NextDeveloper\Commons\Events\ExchangeRates;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\ExchangeRates;

/**
 * Class ExchangeRatesUpdatedEvent
 * @package NextDeveloper\Commons\Events
 */
class ExchangeRatesUpdatedEvent
{
    use SerializesModels;

    /**
     * @var ExchangeRates
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(ExchangeRates $model = null) {
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