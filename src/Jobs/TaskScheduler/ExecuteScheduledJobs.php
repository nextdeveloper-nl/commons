<?php

namespace NextDeveloper\Commons\Jobs\TaskScheduler;

use Carbon\Carbon;
use Cron\CronExpression;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Actions\AbstractAction;
use NextDeveloper\Commons\Database\GlobalScopes\LimitScope;
use NextDeveloper\Commons\Database\Models\AvailableActions;
use NextDeveloper\Commons\Database\Models\Domains;
use NextDeveloper\Commons\Database\Models\ScheduledTasksPerspective;
use NextDeveloper\Commons\Database\Models\TaskSchedulers;
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

        $this->runScheduledTasks();
        $this->calculateNextRunDates();
        $this->runNextRunDates();
    }

    private function runNextRunDates() {
        $defaultTimezone = config('app.timezone');

        $now = Carbon::now($defaultTimezone)->format('H:i:00P');

        $tasks = TaskSchedulers::withoutGlobalScope(LimitScope::class)
            ->whereRaw('next_run_at <= now()')
            ->where('cron_expression', '!=', null)
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

            $cron = new CronExpression($task->cron_expression);
            $task->update([
                'next_run_at' => $cron->getNextRunDate($now, 0, true, $defaultTimezone)
            ]);
        }
    }

    private function calculateNextRunDates()
    {
        $defaultTimezone = config('app.timezone');

        $now = Carbon::now($defaultTimezone)->format('H:i:00P');
        //  Get tasks with cron expression and without next_run_at
        $tasks = TaskSchedulers::withoutGlobalScope(LimitScope::class)
            ->whereRaw('next_run_at <= now()')
            ->where('cron_expression', '!=', null)
            ->get();

        foreach ($tasks as $task) {
            $cron = new CronExpression($task->cron_expression);
            $task->update([
                'next_run_at' => $cron->getNextRunDate($now, 0, true, $defaultTimezone)
            ]);
        }
    }

    private function runScheduledTasks()
    {
        $defaultTimezone = config('app.timezone');

        $now = Carbon::now($defaultTimezone)->format('H:i:00P');

        //  Note that ScheduledTasks are a view not a table!!!! cron type of scheduling is not supported here.
        //  We will run only tasks that have time_of_day set to current time or null
        //  If time_of_day is null, it means that the task should run every time
        //  when the scheduler is executed.
        $tasks = ScheduledTasksPerspective::withoutGlobalScopes()
            ->whereRaw("time_of_day::time = (CURRENT_TIMESTAMP AT TIME ZONE ?)::time", [$now])
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
