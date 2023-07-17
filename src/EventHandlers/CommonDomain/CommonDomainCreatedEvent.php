<?php

namespace NextDeveloper\Commons\EventHandlers\CommonDomain;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class CommonDomainCreatedEvent
 * @package PlusClouds\Account\Handlers\Events
 */
class CommonDomainCreatedEvent implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {

    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}