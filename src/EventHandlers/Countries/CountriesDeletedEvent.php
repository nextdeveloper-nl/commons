<?php

namespace NextDeveloper\Commons\EventHandlers\Countries;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class CountriesDeletedEvent
 * @package PlusClouds\Account\Handlers\Events
 */
class CountriesDeletedEvent implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {

    }
}
