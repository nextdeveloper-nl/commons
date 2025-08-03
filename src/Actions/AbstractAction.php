<?php

namespace NextDeveloper\Commons\Actions;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use NextDeveloper\Commons\Database\Models\ActionLogs;
use NextDeveloper\Commons\Database\Models\Actions;
use NextDeveloper\Commons\Exceptions\CannotValidateActionRequestException;
use NextDeveloper\Commons\Exceptions\NotAllowedException;
use NextDeveloper\Commons\Exceptions\NotFoundException;
use NextDeveloper\Commons\Helpers\ActionsHelper;
use NextDeveloper\IAM\Helpers\UserHelper;

class AbstractAction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $allowedRoles = [];

    public $action;

    public $model;

    public $flowId;

    public $nodeId;

    protected $params = null;
    protected $previous = null;

    private $startTime;

    private $latestTime;

    /**
     * @var int We are using this to store the user id of the action owner
     */
    private $userId;

    /**
     * @var int We are using this to store the account id of the action owner
     */
    private $accountId;

    public function __construct($params = null, $previous = null)
    {
        $this->createAction($previous);

        //  Sometimes parameters can be passed as an array, thats why we are setting the first element as the parameters
        if ($params && property_exists($this, 'PARAMS')) {
            if (array_key_exists(0, $params))
                $params = $params[0];

            $validator = Validator::make($params, $this::PARAMS);

            throw_if(
                $validator->fails(),
                new CannotValidateActionRequestException($validator->errors()->all())
            );
        }

        foreach ($this->allowedRoles as $role) {
            if (!UserHelper::hasRole($role)) {
                throw new NotAllowedException('You dont have the right privilege and/or role to run this action.');
            }
        }

        if (!ActionsHelper::saveInDb()) return;

        $this->userId = UserHelper::me() ? UserHelper::me()->id : null;
        $this->accountId = UserHelper::currentAccount() ? UserHelper::currentAccount()->id : null;

        $this->params = $params;
        $this->previous = $previous;

        return $this;
    }

    public function runAsAdministrator()
    {
        Log::info('[ActionLog] Running as administrator in action: ' . get_class($this));

        $this->action->update([
            'iam_user_id'       => config('leo.current_user_id'),
            'iam_account_id'    => config('leo.current_account_id')
        ]);

        return $this;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function validateParameters($parameters, $validation)
    {
        return true;
    }

    /**
     * Returns the action
     *
     * @return mixed
     */
    public function getActionId()
    {
        if (!$this->action) {
            $this->createAction();
        }

        return $this->action->uuid;
    }

    private function createAction($previous = null)
    {
        if (!ActionsHelper::saveInDb()) return;

        $class = get_class($this->model);
        $id = $this->model->id;

        if($previous) {
            UserHelper::setUserById($previous->getUserId());
            UserHelper::setCurrentAccountById($previous->getAccountId());
        }

        $this->action = Actions::create([
            'action' => get_class($this),
            'progress' => 0,
            'runtime' => 0,
            'object_id' => $id,
            'object_type' => $class,
            'iam_account_id' => $this->getAccountId(),
            'iam_user_id' => $this->getUserId()
        ]);

        $this->action = $this->action->fresh();
    }

    public function getUserId()
    {
        if (UserHelper::me()) {
            return UserHelper::me()->id;
        }

        if ($this->action) {
            if ($this->action->iam_user_id) {
                return $this->model->iam_user_id;
            }
        }

        if (property_exists($this->model, 'iam_user_id')) {
            return $this->model->iam_user_id;
        }

        return null;
    }

    public function getAccountId()
    {
        if (UserHelper::me()) {
            return UserHelper::currentAccount()->id;
        }

        if ($this->action) {
            if ($this->action->iam_account_id) {
                return $this->model->iam_account_id;
            }
        }

        if (property_exists($this->model, 'iam_account_id')) {
            return $this->model->iam_account_id;
        }

        return null;
    }

    public function setFlow($flow)
    {
        $this->flowId = $flow;
    }

    public function getFlow()
    {
        return $this->flowId;
    }

    public function setNode($node)
    {
        $this->nodeId = $node;
    }

    public function getNode()
    {
        return $this->nodeId;
    }

    public function setUserAsThisActionOwner()
    {
        //  We need to return because when action runs and there is no user attached to it, this part is creating error.
        if(!$this->action) {
            if(!UserHelper::me())
                throw new NotFoundException('Cannot run this function without an action model. Seems like ' .
                    'you are not saving this action, also you dont have a user preset. Are you trying to run this ' .
                    'action ad admin maybe ?');

            return;
        }

        UserHelper::setUserById($this->action->iam_user_id);
        UserHelper::setCurrentAccountById($this->action->iam_account_id);
    }

    public function setProgress($percent, $completedAction)
    {
        if(ActionsHelper::logInFile())
            Log::info('[ActionLog]' . $completedAction . ' with percent: ' . $percent);

        if (!ActionsHelper::saveInDb()) return;

        //  We put this here to fix the action owner problem. But we need to create much more smart solution for this
        //  in the next version of this module.
        $this->setUserAsThisActionOwner();

        if (!$this->startTime) {
            $this->startTime = now();
        }

        $diff = 0;

        if (!$this->latestTime) {
            $this->latestTime = now();
        } else {
            $now = Carbon::now();
            $diff = $now->diffInMilliseconds($this->startTime);

            $this->latestTime = now();
        }

        if (!$this->action) {
            $this->createAction();
        }

        UserHelper::setUserById($this->getUserId());

        if (config('leo.debug.action_logs')) {
            Log::info('[ActionLog]' . $completedAction . ' / Diff: ' . $diff . 'ms');
        }

        $this->action->update([
            'progress' => $percent,
            'runtime' => $diff
        ]);

        ActionLogs::create([
            'common_action_id' => $this->action->id,
            'log' => $completedAction,
            'runtime' => $diff,
            'iam_account_id' => $this->getAccountId(),
            'iam_user_id' => $this->getUserId()
        ]);
    }

    public function setFinishedWithError($log = 'Action failed')
    {
        //  We put this here to fix the action owner problem. But we need to create much more smart solution for this
        //  in the next version of this module.
        $this->setUserAsThisActionOwner();
        UserHelper::setUserById($this->getUserId());

        if(ActionsHelper::logInFile())
            Log::error('[ActionLog][FAIL] ' . $log);

        if (!ActionsHelper::saveInDb()) return;

        $now = Carbon::now();
        $diff = $now->diffInMilliseconds($this->startTime);

        if (config('leo.debug.action_logs')) {
            Log::info('[ActionLog][ERROR]' . $log . ' / Diff: ' . $diff . 'ms');
        }

        try {
            $actionModel = new ActionLogs();
            $actionModel->unsetEventDispatcher();

            $actionModel->create([
                'common_action_id' => $this->action->id,
                'log' => 'Error: ' . $log,
                'runtime' => $diff,
                'iam_account_id' => $this->getAccountId(),
                'iam_user_id' => $this->getUserId()
            ]);
        } catch (\Exception $e) {
            Log::error(__METHOD__ . ' | I cannot create action log. And the reason is; ' . $e->getMessage());
            Log::error($e->getTraceAsString());
        }

        $this->action->update([
            'progress' => -1,
            'runtime' => $diff
        ]);
    }

    public function setFinished($log = 'Action finished')
    {
        if(ActionsHelper::logInFile())
            Log::info('[ActionLog] ' . $log);

        if (!ActionsHelper::saveInDb()) return;

        $now = Carbon::now();
        $diff = $now->diffInMilliseconds($this->startTime);

        if (config('leo.debug.action_logs')) {
            Log::info('[ActionLog]' . $log . ' / Diff: ' . $diff . 'ms');
        }

        ActionLogs::create([
            'common_action_id' => $this->action->id,
            'log' => 'Action finished',
            'runtime' => $diff,
            'iam_account_id' => $this->getAccountId(),
            'iam_user_id' => $this->getUserId()
        ]);

        $this->action->update([
            'progress' => 100,
            'runtime' => $diff
        ]);
    }

    public function failed($exception)
    {
        Log::error("Action is failed with message: " . print_r($exception, true));

        $this->setFinishedWithError("In this job, we entered in an errored state.");
    }
}
