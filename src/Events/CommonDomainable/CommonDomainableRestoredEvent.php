<?php

namespace NextDeveloper\Commons\Events\CommonDomainable;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\CommonDomainable;

/**
 * Class CommonDomainableRestoredEvent
 * @package NextDeveloper\Commons\Events
 */
class CommonDomainableRestoredEvent
{
    use SerializesModels;

    /**
     * @var CommonDomainable
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(CommonDomainable $model = null) {
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