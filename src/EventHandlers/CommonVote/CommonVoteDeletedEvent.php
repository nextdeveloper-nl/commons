<?php

namespace NextDeveloper\Commons\EventHandlers\CommonVote;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class CommonVoteDeletedEvent
 * @package PlusClouds\Account\Handlers\Events
 */
class CommonVoteDeletedEvent implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {

    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}