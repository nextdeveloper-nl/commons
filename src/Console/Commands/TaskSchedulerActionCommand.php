<?php

namespace NextDeveloper\Commons\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use NextDeveloper\Commons\Database\Models\AvailableActions;
use NextDeveloper\Commons\Database\Models\TaskSchedulers;
use NextDeveloper\IAM\Helpers\UserHelper;

/**
 * This command handles scheduled tasks execution and their associated actions.
 * It processes due tasks, executes their actions, and updates their scheduling information.
 */
class TaskSchedulerActionCommand extends Command
{
    protected $signature = 'nextdeveloper:task-scheduler-action';

    protected $description = 'Execute scheduled tasks and their associated actions.';

    /**
     * Main command handler that processes all scheduled tasks
     *
     * @return void
     */
    public function handle(): void
    {
        // Set the admin as the current user
        // This is to ensure that the task is executed with the admin credentials to avoid permission issues
        UserHelper::setAdminAsCurrentUser();

        $this->info('TaskSchedulerActionCommand started');

        try {
            // Get all tasks that are due to run
            $tasks = TaskSchedulers::withoutGlobalScopes()->get();

            $this->info('Found ' . $tasks->count() . ' tasks to process');

            foreach ($tasks as $task) {
                // Fix: Inverted logic - only process tasks that ARE due
                if (!$task->isDue()) {
                    $this->line('Skipping task: ' . $task->name . ' (not due yet)');
                    continue;
                }

                $this->processTask($task);
            }
        } catch (\Exception $e) {
            $this->error('Fatal error in TaskSchedulerActionCommand: ' . $e->getMessage());
            Log::error('TaskSchedulerActionCommand fatal error: ' . $e->getMessage(), [
                'exception' => $e
            ]);
        }

        $this->info('TaskSchedulerActionCommand completed');
    }

    /**
     * Process an individual task
     *
     * @param TaskSchedulers $task
     * @return void
     */
    protected function processTask(TaskSchedulers $task): void
    {
        try {
            $this->info('Executing task: ' . $task->name);

            // Get the associated action
            $action = $this->getTaskAction($task);
            if (!$action) {
                return;
            }

            // Execute the action
            $result = $this->executeAction($task, $action);

            // Update task execution information
            $this->updateTaskAfterExecution($task);

            $this->info('Task completed successfully: ' . $task->name);

        } catch (\Exception $e) {
            $this->handleTaskError($task, $e);
        }
    }

    /**
     * Get the action associated with a task
     *
     * @param TaskSchedulers $task
     * @return AvailableActions|null
     */
    protected function getTaskAction(TaskSchedulers $task): ?AvailableActions
    {
        $action = AvailableActions::withoutGlobalScopes()
                    ->where('id', $task->common_available_action_id)
                    ->first();

        if (!$action) {
            $this->error('Action not found for task: ' . $task->name);

            // Update task with error information
            $task->output = 'Error: Action not found';
            $task->last_run = Carbon::now();
            $task->save();

            return null;
        }

        return $action;
    }

    /**
     * Update task scheduling information after execution
     *
     * @param TaskSchedulers $task
     * @return void
     */
    protected function updateTaskAfterExecution(TaskSchedulers $task): void
    {
        // Update the last_run time
        $task->last_run = Carbon::now();

        // Calculate next run time based on schedule parameters
        if ($task->params && isset($task->params['schedule'])) {
            $schedule = $task->params['schedule'];

            if (isset($schedule['frequency']) && isset($schedule['interval'])) {
                $nextRun = Carbon::now();
                $interval = (int)$schedule['interval'];

                // Add the interval to the next run time based on frequency
                switch ($schedule['frequency']) {
                    case 'i': // minutes
                        $nextRun->addMinutes($interval);
                        break;
                    case 'h': // hours
                        $nextRun->addHours($interval);
                        break;
                    case 'd': // days
                        $nextRun->addDays($interval);
                        break;
                    case 'w': // weeks
                        $nextRun->addWeeks($interval);
                        break;
                    case 'm': // months
                        $nextRun->addMonths($interval);
                        break;
                    default:
                        $this->warn('Unknown frequency: ' . $schedule['frequency'] . ' for task: ' . $task->name);
                        // Default to daily if frequency is unknown
                        $nextRun->addDay();
                }

                $task->next_run = $nextRun;
            }
        }

        $task->saveQuietly();
    }

    /**
     * Handle errors that occur during task execution
     *
     * @param TaskSchedulers $task
     * @param \Exception $exception
     * @return void
     */
    protected function handleTaskError(TaskSchedulers $task, \Exception $exception): void
    {
        $errorMessage = $exception->getMessage();
        $this->error('Error executing task: ' . $task->name . ' - ' . $errorMessage);

        Log::error('TaskSchedulerActionCommand error: ' . $errorMessage, [
            'task_id' => $task->id,
            'task_name' => $task->name,
            'exception' => $exception
        ]);

        // Update task with error information
        $task->output = 'Error: ' . $errorMessage;
        $task->last_run = Carbon::now();
        $task->save();
    }

    /**
     * Execute the action associated with a task
     *
     * @param TaskSchedulers $task
     * @param AvailableActions $action
     * @return mixed
     * @throws \Exception
     */
    protected function executeAction(TaskSchedulers $task, AvailableActions $action): mixed
    {
        $className = $action->class;

        if (!class_exists($className)) {
            throw new \Exception("Action class {$className} does not exist");
        }

        // Get the action object
        $actionObject = $this->resolveActionObject($task, $action);

        // Prepare parameters
        $parameters = $task->params ?? [];

        // Create an instance of the action class
        $result = $className::dispatchSync($actionObject, $parameters);

        // Store the result in the task output
        $task->output = is_string($result) ? $result : json_encode($result);

        return $result;
    }

    /**
     * Resolve the action object based on the task and action configuration
     *
     * @param TaskSchedulers $task
     * @param AvailableActions $action
     * @return mixed
     * @throws \Exception
     */
    protected function resolveActionObject(TaskSchedulers $task, AvailableActions $action): mixed
    {
        $taskObjectId = $task->object_id;
        $actionObjectClass = $action->input;

        if (empty($taskObjectId)) {
            throw new \Exception("Task object ID is missing for task: " . $task->name);
        }

        if (empty($actionObjectClass)) {
            throw new \Exception("Action object class is missing for action: " . $action->name);
        }

        // Special case for NextDeveloper\Intelligence namespace
        if (str_starts_with($actionObjectClass, 'NextDeveloper\Intelligence')) {
            // Replace NextDeveloper\Intelligence with App\Models while preserving the model name
            // Example: NextDeveloper\Intelligence\EmailAddresses -> App\Models\EmailAddresses
            $actionObjectClass = str_replace('NextDeveloper\Intelligence', 'App\Models', $actionObjectClass);
        }

        // If the action object class already contains Database\Models\
        if (str_contains($actionObjectClass, 'Database\Models')) {
            $model = $actionObjectClass;
        } else {
            // Extract the model name from the class path
            $actionObjectModel = substr($actionObjectClass, strrpos($actionObjectClass, '\\') + 1);

            // Remove the model part from the namespace
            $actionObjectNamespace = substr($actionObjectClass, 0, strrpos($actionObjectClass, '\\'));

            // Construct the full model class path
            $model = $actionObjectNamespace . '\Database\Models\\' . $actionObjectModel;
        }

        // Find the object
        $actionObject = $model::withoutGlobalScopes()->where('id', $taskObjectId)->first();

        if (!$actionObject) {
            throw new \Exception("Object with ID {$taskObjectId} not found for task: " . $task->name);
        }

        return $actionObject;
    }
}
