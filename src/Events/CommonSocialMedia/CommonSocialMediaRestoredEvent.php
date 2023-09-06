<?php

namespace NextDeveloper\Commons\Events\CommonSocialMedia;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\CommonSocialMedia;

/**
 * Class CommonSocialMediaRestoredEvent
 * @package NextDeveloper\Commons\Events
 */
class CommonSocialMediaRestoredEvent
{
    use SerializesModels;

    /**
     * @var CommonSocialMedia
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(CommonSocialMedia $model = null) {
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