<?php

namespace NextDeveloper\Commons\Events\Actions;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\Actions;

/**
 * Class ActionsRestoredEvent
 *
 * @package NextDeveloper\Commons\Events
 */
class ActionsRestoredEvent
{
    use SerializesModels;

    /**
     * @var Actions
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(Actions $model = null)
    {
        $this->_model = $model;
    }

    /**
     * @param int $value
     *
     * @return AbstractEvent
     */
    public function setTimestamp($value)
    {
        $this->timestamp = $value;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}