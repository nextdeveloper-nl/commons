<?php

namespace NextDeveloper\Commons\Events\Medium;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\Medium;

/**
 * Class MediumDeletingEvent
 * @package NextDeveloper\Commons\Events
 */
class MediumDeletingEvent
{
    use SerializesModels;

    /**
     * @var Medium
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(Medium $model = null) {
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