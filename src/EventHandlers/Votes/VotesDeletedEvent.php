<?php

namespace NextDeveloper\Commons\EventHandlers\Votes;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class CommonVotesDeletedEvent
 * @package PlusClouds\Account\Handlers\Events
 */
class CommonVotesDeletedEvent implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {

    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}