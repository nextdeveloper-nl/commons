<?php

namespace NextDeveloper\Commons\Events\Addresses;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\Addresses;

/**
 * Class AddressesRestoringEvent
 * @package NextDeveloper\Commons\Events
 */
class AddressesRestoringEvent
{
    use SerializesModels;

    /**
     * @var Addresses
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(Addresses $model = null) {
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