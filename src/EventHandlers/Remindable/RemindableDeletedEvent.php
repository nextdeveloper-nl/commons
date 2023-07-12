<?php

namespace NextDeveloper\Commons\EventHandlers\Remindable;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class RemindableDeletedEvent
 * @package PlusClouds\Account\Handlers\Events
 */
class RemindableDeletedEvent implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {

    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}