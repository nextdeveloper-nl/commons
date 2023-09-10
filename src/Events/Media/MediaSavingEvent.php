<?php

namespace NextDeveloper\Commons\Events\Media;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\Media;

/**
 * Class MediaSavingEvent
 * @package NextDeveloper\Commons\Events
 */
class MediaSavingEvent
{
    use SerializesModels;

    /**
     * @var Media
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(Media $model = null) {
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