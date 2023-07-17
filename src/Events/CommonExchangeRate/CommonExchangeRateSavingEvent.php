<?php

namespace NextDeveloper\Commons\Events\CommonExchangeRate;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\CommonExchangeRate;

/**
 * Class CommonExchangeRateSavingEvent
 * @package NextDeveloper\Commons\Events
 */
class CommonExchangeRateSavingEvent
{
    use SerializesModels;

    /**
     * @var CommonExchangeRate
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(CommonExchangeRate $model = null) {
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