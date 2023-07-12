<?php

namespace NextDeveloper\Commons\Events\ExchangeRate;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\ExchangeRate;

/**
 * Class ExchangeRateDeletedEvent
 * @package NextDeveloper\Commons\Events
 */
class ExchangeRateDeletedEvent
{
    use SerializesModels;

    /**
     * @var ExchangeRate
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(ExchangeRate $model = null) {
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