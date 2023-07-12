<?php

namespace NextDeveloper\Commons\EventHandlers\ExchangeRate;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class ExchangeRateUpdatedEvent
 * @package PlusClouds\Account\Handlers\Events
 */
class ExchangeRateUpdatedEvent implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {

    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}