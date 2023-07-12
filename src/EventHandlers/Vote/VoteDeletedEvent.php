<?php

namespace NextDeveloper\Commons\EventHandlers\Vote;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class VoteDeletedEvent
 * @package PlusClouds\Account\Handlers\Events
 */
class VoteDeletedEvent implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {

    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}