<?php

namespace NextDeveloper\Commons\EventHandlers\Registries;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class CommonRegistriesDeletedEvent
 * @package PlusClouds\Account\Handlers\Events
 */
class CommonRegistriesDeletedEvent implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {

    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}