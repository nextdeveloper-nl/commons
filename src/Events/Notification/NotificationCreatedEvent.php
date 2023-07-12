<?php

namespace NextDeveloper\Commons\Events\Notification;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\Notification;

/**
 * Class NotificationCreatedEvent
 * @package NextDeveloper\Commons\Events
 */
class NotificationCreatedEvent
{
    use SerializesModels;

    /**
     * @var Notification
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(Notification $model = null) {
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