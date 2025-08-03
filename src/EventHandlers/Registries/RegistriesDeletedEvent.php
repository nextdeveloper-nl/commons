<?php

namespace NextDeveloper\Commons\EventHandlers\Registries;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
