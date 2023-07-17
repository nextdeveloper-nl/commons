<?php

namespace NextDeveloper\Commons\Events\CommonComment;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\CommonComment;

/**
 * Class CommonCommentCreatedEvent
 * @package NextDeveloper\Commons\Events
 */
class CommonCommentCreatedEvent
{
    use SerializesModels;

    /**
     * @var CommonComment
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(CommonComment $model = null) {
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