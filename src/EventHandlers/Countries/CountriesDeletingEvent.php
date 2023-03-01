<?php

namespace NextDeveloper\Commons\EventHandlers\Countries;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class CountriesDeletingEvent
 * @package PlusClouds\Account\Handlers\Events
 */
class CountriesDeletingEvent implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {

    }
}
