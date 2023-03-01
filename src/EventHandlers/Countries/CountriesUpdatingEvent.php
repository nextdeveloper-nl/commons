<?php

namespace NextDeveloper\Commons\EventHandlers\Countries;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class CountriesUpdatingEvent
 * @package PlusClouds\Account\Handlers\Events
 */
class CountriesUpdatingEvent implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {

    }
}
