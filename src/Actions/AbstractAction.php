<?php

namespace NextDeveloper\Commons\Actions;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use NextDeveloper\Commons\Common\Timer\Timer;
use NextDeveloper\Commons\Database\Models\ActionLogs;
use NextDeveloper\Commons\Database\Models\Actions;
use NextDeveloper\Commons\Exceptions\CannotValidateActionRequestException;
use NextDeveloper\CRM\Database\Models\Users;
use NextDeveloper\IAM\Database\Scopes\AuthorizationScope;
use NextDeveloper\IAM\Helpers\UserHelper;

class AbstractAction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $action;

    public $model;

    public $flowId;

    public $nodeId;

    private $startTime;

    private $latestTime;

    public function __construct($params = null)
    {
        if($params) {
            $validator = Validator::make($params, $this::PARAMS);
            throw_if(
                $validator->fails(),
                new CannotValidateActionRequestException($validator->errors()->all())
            );
        }

        $this->setUserAsThisActionOwner();
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
        UserHelper::setUserById($this->getUserId());
        UserHelper::setCurrentAccountById($this->getAccountId());
    }

    public function setProgress($percent, $completedAction) {
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
            'progress'  =>  100,
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
}
