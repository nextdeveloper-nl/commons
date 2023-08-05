<?php

namespace NextDeveloper\Commons\EventHandlers\CommonDomainable;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class CommonDomainableDeletedEvent
 * @package PlusClouds\Account\Handlers\Events
 */
class CommonDomainableDeletedEvent implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {

    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}