<?php

namespace NextDeveloper\Commons\Events\Meta;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\Meta;

/**
 * Class MetaSavingEvent
 * @package NextDeveloper\Commons\Events
 */
class MetaSavingEvent
{
    use SerializesModels;

    /**
     * @var Meta
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(Meta $model = null) {
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