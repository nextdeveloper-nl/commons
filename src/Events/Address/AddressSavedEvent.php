<?php

namespace NextDeveloper\Commons\Events\Address;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\Address;

/**
 * Class AddressSavedEvent
 * @package NextDeveloper\Commons\Events
 */
class AddressSavedEvent
{
    use SerializesModels;

    /**
     * @var Address
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(Address $model = null) {
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