<?php

namespace NextDeveloper\Commons\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use NextDeveloper\Commons\Common\Timer\Timer;
use NextDeveloper\Commons\Database\Models\ActionLogs;
use NextDeveloper\Commons\Database\Models\Actions;
use NextDeveloper\CRM\Database\Models\Users;

class AbstractAction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $action;

    public $model;

    private $timer;

    /**
     * This action takes a user object and assigns an Account Manager
     *
     * @param Users $users
     */
    public function __construct()
    {
        $class = get_class($this->model);
        $id = $this->model->id;

        $action = get_class($this);

        $this->action = Actions::create([
            'action'    =>  $action,
            'progress'  =>  0,
            'runtime'   =>  0,
            'object_id'     =>  $id,
            'object_type'   =>  $class
        ]);

//        $this->timer = new Timer();
//        $this->timer->diff('Action starts');
    }

    public function getAction()
    {
        return $this->action;
    }

    public function setProgress($percent, $completedAction) {
        ActionLogs::create([
            'common_action_id'  =>  $this->action->id,
            'log'   =>  $completedAction,
            //'runtime'   =>  $this->timer->diff($completedAction)
        ]);
    }

    public function setFinished()
    {
        ActionLogs::create([
            'common_action_id'  =>  $this->action->id,
            'log'   =>  'Action finished',
            //'runtime'   =>  $this->timer->diff('Action finished')
        ]);

        $this->action->update([
            'progress'  =>  100,
            //'runtime'   =>  $this->timer->totalDiff()
        ]);
    }
}
