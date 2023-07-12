<?php

namespace NextDeveloper\Commons\EventHandlers\Notification;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class NotificationCreatedEvent
 * @package PlusClouds\Account\Handlers\Events
 */
class NotificationCreatedEvent implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {

    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}