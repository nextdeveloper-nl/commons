<?php

namespace NextDeveloper\Commons\Events\Remindable;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\Remindable;

/**
 * Class RemindableSavingEvent
 * @package NextDeveloper\Commons\Events
 */
class RemindableSavingEvent
{
    use SerializesModels;

    /**
     * @var Remindable
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(Remindable $model = null) {
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