<?php

namespace NextDeveloper\Commons\Events\Comment;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\Comment;

/**
 * Class CommentCreatedEvent
 * @package NextDeveloper\Commons\Events
 */
class CommentCreatedEvent
{
    use SerializesModels;

    /**
     * @var Comment
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(Comment $model = null) {
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