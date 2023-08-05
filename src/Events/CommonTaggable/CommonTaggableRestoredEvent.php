<?php

namespace NextDeveloper\Commons\Events\CommonTaggable;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\CommonTaggable;

/**
 * Class CommonTaggableRestoredEvent
 * @package NextDeveloper\Commons\Events
 */
class CommonTaggableRestoredEvent
{
    use SerializesModels;

    /**
     * @var CommonTaggable
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(CommonTaggable $model = null) {
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