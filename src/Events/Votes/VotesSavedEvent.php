<?php

namespace NextDeveloper\Commons\Events\Votes;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\Votes;

/**
 * Class VotesSavedEvent
 * @package NextDeveloper\Commons\Events
 */
class VotesSavedEvent
{
    use SerializesModels;

    /**
     * @var Votes
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(Votes $model = null) {
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