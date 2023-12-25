<?php

namespace NextDeveloper\Commons\EventHandlers\ActionLogsCreatedEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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