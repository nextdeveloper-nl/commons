<?php

namespace NextDeveloper\Commons\Events\CommonLanguage;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\CommonLanguage;

/**
 * Class CommonLanguageSavedEvent
 * @package NextDeveloper\Commons\Events
 */
class CommonLanguageSavedEvent
{
    use SerializesModels;

    /**
     * @var CommonLanguage
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(CommonLanguage $model = null) {
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