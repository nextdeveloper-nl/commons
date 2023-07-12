<?php

namespace NextDeveloper\Commons\Events\Domain;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\Domain;

/**
 * Class DomainUpdatingEvent
 * @package NextDeveloper\Commons\Events
 */
class DomainUpdatingEvent
{
    use SerializesModels;

    /**
     * @var Domain
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(Domain $model = null) {
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