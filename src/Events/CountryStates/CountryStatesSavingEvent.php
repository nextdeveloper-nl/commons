<?php

namespace NextDeveloper\Commons\Events\CountryStates;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\CountryStates;

/**
 * Class CountryStatesSavingEvent
 *
 * @package NextDeveloper\Commons\Events
 */
class CountryStatesSavingEvent
{
    use SerializesModels;

    /**
     * @var CountryStates
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(CountryStates $model = null)
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