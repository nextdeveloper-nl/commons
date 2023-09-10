<?php

namespace NextDeveloper\Commons\EventHandlers\DisposableEmails;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class CommonDisposableEmailsDeletedEvent
 * @package PlusClouds\Account\Handlers\Events
 */
class CommonDisposableEmailsDeletedEvent implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {

    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}