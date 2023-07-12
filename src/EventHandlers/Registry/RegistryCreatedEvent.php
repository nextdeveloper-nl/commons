<?php

namespace NextDeveloper\Commons\EventHandlers\Registry;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class RegistryCreatedEvent
 * @package PlusClouds\Account\Handlers\Events
 */
class RegistryCreatedEvent implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {

    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}