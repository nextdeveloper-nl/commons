<?php

namespace NextDeveloper\Commons\Jobs\TaskScheduler;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Actions\AbstractAction;
use NextDeveloper\Commons\Database\Models\AvailableActions;
use NextDeveloper\Commons\Database\Models\Domains;
use NextDeveloper\Commons\Database\Models\ScheduledTasks;
use NextDeveloper\IAM\Database\Models\Users;
use NextDeveloper\IAM\Database\Scopes\AuthorizationScope;
use NextDeveloper\IAM\Helpers\UserHelper;

/**
 * This action validates the domain by using http(s) protocol. It will check if the domain is ownership by
 * looking at the server if the designated file is there with the given content.
 */

class ExecuteScheduledJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * handle
     *
     * @return void
     */
    public function handle()
    {
        UserHelper::setAdminAsCurrentUser();

        $defaultTimezone = config('app.timezone');

        $now = Carbon::now($defaultTimezone)->format('H:i:00P');

        //  Note that ScheduledTasks are a view not a table!!!!
        $tasks = ScheduledTasks::withoutGlobalScopes()
            ->where('time_of_day', $now)
            ->orWhereNull('time_of_day')
            ->get();

        foreach ($tasks as $task) {
            $object = app($task->object_type)::where('id', $task->object_id)->first();

            $action = AvailableActions::withoutGlobalScope(AuthorizationScope::class)
                ->where('id', $task->common_available_action_id)
                ->first();

            if(class_exists($action->class)) {
                $scheduledAction = new $action->class($object);

                dispatch(new $scheduledAction($object));
            }
        }
    }
}
