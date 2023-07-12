<?php

namespace NextDeveloper\Commons\EventHandlers\DisposableEmail;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class DisposableEmailDeletedEvent
 * @package PlusClouds\Account\Handlers\Events
 */
class DisposableEmailDeletedEvent implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {

    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}