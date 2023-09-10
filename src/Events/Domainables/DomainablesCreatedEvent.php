<?php

namespace NextDeveloper\Commons\Events\Domainables;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\Domainables;

/**
 * Class DomainablesCreatedEvent
 * @package NextDeveloper\Commons\Events
 */
class DomainablesCreatedEvent
{
    use SerializesModels;

    /**
     * @var Domainables
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(Domainables $model = null) {
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