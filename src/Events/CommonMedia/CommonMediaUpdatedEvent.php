<?php

namespace NextDeveloper\Commons\Events\CommonMedia;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\CommonMedia;

/**
 * Class CommonMediaUpdatedEvent
 * @package NextDeveloper\Commons\Events
 */
class CommonMediaUpdatedEvent
{
    use SerializesModels;

    /**
     * @var CommonMedia
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(CommonMedia $model = null) {
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