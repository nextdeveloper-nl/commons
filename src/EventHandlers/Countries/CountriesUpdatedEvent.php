<?php

namespace NextDeveloper\Commons\EventHandlers\Countries;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class CountriesUpdatedEvent
 * @package PlusClouds\Account\Handlers\Events
 */
class CountriesUpdatedEvent implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {

    }
}
