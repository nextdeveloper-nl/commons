<?php

namespace NextDeveloper\Commons\Events\Language;

use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Database\Models\Language;

/**
 * Class LanguageSavingEvent
 * @package NextDeveloper\Commons\Events
 */
class LanguageSavingEvent
{
    use SerializesModels;

    /**
     * @var Language
     */
    public $_model;

    /**
     * @var int|null
     */
    protected $timestamp = null;

    public function __construct(Language $model = null) {
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