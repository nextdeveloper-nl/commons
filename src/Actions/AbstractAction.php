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

    public function __construct()
    {
    }

    public function getAction()
    {
        return $this->action;
    }

    private function createAction() {
        $class = get_class($this->model);
        $id = $this->model->id;

        $this->action = Actions::create([
            'action'    =>  get_class($this),
            'progress'  =>  0,
            'runtime'   =>  0,
            'object_id'     =>  $id,
            'object_type'   =>  $class
        ]);
    }

    public function setProgress($percent, $completedAction) {
        if(!$this->action) {
            $this->createAction();
        }

        ActionLogs::create([
            'common_action_id'  =>  $this->action->id,
            'log'   =>  $completedAction,
            //'runtime'   =>  $this->timer->diff($completedAction)
        ]);
    }

    public function setFinished($log = 'Action finished')
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
