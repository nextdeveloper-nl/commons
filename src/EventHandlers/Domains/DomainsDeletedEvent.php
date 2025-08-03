<?php

namespace NextDeveloper\Commons\EventHandlers\Domains;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

/**
 * Class CommonDomainsDeletedEvent
 * @package PlusClouds\Account\Handlers\Events
 */
class CommonDomainsDeletedEvent implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {

    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}
