<?php

namespace NextDeveloper\Commons\Events\States;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\States;

/**
 * Class StatesSavingEvent
 * @package NextDeveloper\Commons\Events
 */
class StatesSavingEvent
{
    use SerializesModels;

    /**
     * @var States
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(States $model = null) {
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