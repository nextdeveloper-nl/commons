<?php

namespace NextDeveloper\Commons\EventHandlers\Countries;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class CountriesCreatingEvent
 * @package PlusClouds\Account\Handlers\Events
 */
class CountriesCreatingEvent implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {

    }
}
