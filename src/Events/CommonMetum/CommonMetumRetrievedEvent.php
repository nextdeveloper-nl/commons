<?php

namespace NextDeveloper\Commons\Events\CommonMetum;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\CommonMetum;

/**
 * Class CommonMetumRetrievedEvent
 * @package NextDeveloper\Commons\Events
 */
class CommonMetumRetrievedEvent
{
    use SerializesModels;

    /**
     * @var CommonMetum
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(CommonMetum $model = null) {
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