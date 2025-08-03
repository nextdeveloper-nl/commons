<?php

namespace NextDeveloper\Commons\EventHandlers\Validatables;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

/**
 * Class CommonValidatableDeletedEvent
 * @package PlusClouds\Account\Handlers\Events
 */
class CommonValidatableDeletedEvent implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {

    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}
