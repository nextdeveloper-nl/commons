<?php

namespace NextDeveloper\Commons\EventHandlers\Comments;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class CommonCommentsDeletedEvent
 * @package PlusClouds\Account\Handlers\Events
 */
class CommonCommentsDeletedEvent implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event)
    {

    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}