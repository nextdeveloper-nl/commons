<?php

namespace NextDeveloper\Commons\EventHandlers\ActionsCreatedEvent;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

/**
 * Class ActionsCreatedEvent
 *
 * @package PlusClouds\Account\Handlers\Events
 */
class ActionsCreatedEvent implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {

    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}
