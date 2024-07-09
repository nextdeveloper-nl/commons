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
use NextDeveloper\IAM\Helpers\UserHelper;

class AbstractAction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $allowedRoles = [];

    public $action;

    public $model;

    public $flowId;

    public $nodeId;

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

    public function __construct($params = null)
    {
        $this->createAction();

        //  Sometimes parameters can be passed as an array, thats why we are setting the first element as the parameters
        if($params) {
            if(array_key_exists(0, $params))
                $params = $params[0];

            $validator = Validator::make($params, $this::PARAMS);

            throw_if(
                $validator->fails(),
                new CannotValidateActionRequestException($validator->errors()->all())
            );
        }

        foreach ($this->allowedRoles as $role) {
            if(!UserHelper::hasRole($role)) {
                throw new NotAllowedException('You dont have the right privilige and/or role to run this action.');
            }
        }

        $this->userId = UserHelper::me()->id;
        $this->accountId = UserHelper::currentAccount()->id;
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
    public function getActionId() {
        if(!$this->action) {
            $this->createAction();
        }

        return $this->action->uuid;
    }

    private function createAction() {
        $class = get_class($this->model);
        $id = $this->model->id;

        $this->action = Actions::create([
            'action'    =>  get_class($this),
            'progress'  =>  0,
            'runtime'   =>  0,
            'object_id'     =>  $id,
            'object_type'   =>  $class,
            'iam_account_id'    => $this->getAccountId(),
            'iam_user_id'       =>  $this->getUserId()
        ]);

        $this->action = $this->action->fresh();
    }

    public function getUserId() {
        if(UserHelper::me()) {
            return UserHelper::me()->id;
        }

        if(property_exists($this->model, 'iam_user_id')) {
            return $this->model->iam_user_id;
        }

        if($this->action) {
            if($this->action->iam_user_id) {
                return $this->model->iam_user_id;
            }
        }

        return null;
    }

    public function getAccountId() {
        if(UserHelper::me()) {
            return UserHelper::currentAccount()->id;
        }

        if(property_exists($this->model, 'iam_account_id')) {
            return $this->model->iam_account_id;
        }

        if($this->action) {
            if($this->action->iam_account_id) {
                return $this->model->iam_account_id;
            }
        }

        return null;
    }

    public function setFlow($flow) {
        $this->flowId = $flow;
    }

    public function getFlow() {
        return $this->flowId;
    }

    public function setNode($node) {
        $this->nodeId = $node;
    }

    public function getNode() {
        return $this->nodeId;
    }

    public function setUserAsThisActionOwner()
    {
        UserHelper::setUserById($this->action->iam_user_id);
        UserHelper::setCurrentAccountById($this->action->iam_account_id);
    }

    public function setProgress($percent, $completedAction) {
        //  We put this here to fix the action owner problem. But we need to create much more smart solution for this
        //  in the next version of this module.
        $this->setUserAsThisActionOwner();

        if(!$this->startTime) {
            $this->startTime = now();
        }

        $diff = 0;

        if(!$this->latestTime) {
            $this->latestTime = now();
        } else {
            $now = Carbon::now();
            $diff = $now->diffInMilliseconds($this->startTime);

            $this->latestTime = now();
        }

        if(!$this->action) {
            $this->createAction();
        }

        UserHelper::setUserById($this->getUserId());

        if(config('leo.debug.action_logs')) {
            Log::info('[ActionLog]' . $completedAction . ' / Diff: ' . $diff . 'ms');
        }

        $this->action->update([
            'progress'  =>  $percent,
            'runtime'   =>  $diff
        ]);

        ActionLogs::create([
            'common_action_id'  =>  $this->action->id,
            'log'   =>  $completedAction,
            'runtime'   =>  $diff,
            'iam_account_id'    => $this->getAccountId(),
            'iam_user_id'       =>  $this->getUserId()
        ]);
    }

    public function setFinishedWithError($log = 'Action failed')
    {
        $now = Carbon::now();
        $diff = $now->diffInMilliseconds($this->startTime);

        if(config('leo.debug.action_logs')) {
            Log::info('[ActionLog][ERROR]' . $log . ' / Diff: ' . $diff . 'ms');
        }

        ActionLogs::create([
            'common_action_id'  =>  $this->action->id,
            'log'   =>  'Error: ' . $log,
            'runtime'   =>  $diff,
            'iam_account_id'    => $this->getAccountId(),
            'iam_user_id'       =>  $this->getUserId()
        ]);

        $this->action->update([
            'progress'  =>  -1,
            'runtime'   =>  $diff
        ]);
    }

    public function setFinished($log = 'Action finished')
    {
        $now = Carbon::now();
        $diff = $now->diffInMilliseconds($this->startTime);

        if(config('leo.debug.action_logs')) {
            Log::info('[ActionLog]' . $log . ' / Diff: ' . $diff . 'ms');
        }

        ActionLogs::create([
            'common_action_id'  =>  $this->action->id,
            'log'   =>  'Action finished',
            'runtime'   =>  $diff,
            'iam_account_id'    => $this->getAccountId(),
            'iam_user_id'       =>  $this->getUserId()
        ]);

        $this->action->update([
            'progress'  =>  100,
            'runtime'   => $diff
        ]);
    }

    public function failed(\Exception $exception)
    {
        $this->setFinishedWithError("In this job, we entered in an errored state.");
        // Called when the job is failing...
        Log::error("Action is failed with message: " . $exception->getMessage());
        Log::error(json_encode($exception->getTrace()));

    }
}
