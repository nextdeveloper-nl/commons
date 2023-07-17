<?php

namespace NextDeveloper\Commons\Events\CommonDomain;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\CommonDomain;

/**
 * Class CommonDomainDeletedEvent
 * @package NextDeveloper\Commons\Events
 */
class CommonDomainDeletedEvent
{
    use SerializesModels;

    /**
     * @var CommonDomain
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(CommonDomain $model = null) {
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