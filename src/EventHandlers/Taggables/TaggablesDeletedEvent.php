<?php

namespace NextDeveloper\Commons\EventHandlers\Taggables;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class CommonTaggablesDeletedEvent
 * @package PlusClouds\Account\Handlers\Events
 */
class CommonTaggablesDeletedEvent implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {

    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}