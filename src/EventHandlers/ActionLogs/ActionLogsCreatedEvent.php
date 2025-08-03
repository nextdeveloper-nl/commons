<?php

namespace NextDeveloper\Commons\EventHandlers\ActionLogsCreatedEvent;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

/**
 * Class ActionLogsCreatedEvent
 *
 * @package PlusClouds\Account\Handlers\Events
 */
class ActionLogsCreatedEvent implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {

    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}
