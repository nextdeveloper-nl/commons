<?php

namespace NextDeveloper\Commons\Services;

use Cron\CronExpression;
use NextDeveloper\Commons\Database\Filters\TaskSchedulersQueryFilter;
use NextDeveloper\Commons\Services\AbstractServices\AbstractTaskSchedulersService;

/**
 * This class is responsible from managing the data for TaskSchedulers
 *
 * Class TaskSchedulersService.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class TaskSchedulersService extends AbstractTaskSchedulersService
{

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
    public static function get(TaskSchedulersQueryFilter $filter = null, array $params = []): \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        if(array_key_exists('objectType', $params)) {
            if(!array_key_exists('objectId', $params)) {
                throw new \Exception("When you are filtering by object_type, you must provide also object_id.");
            }

            $objectType = request()->get('objectType');
            $objectType = explode('\\', $objectType);
            $objectType = $objectType[0] . '\\' . $objectType[1] . '\\Database\\Models\\' . $objectType[2];

            $objectId = request()->get('objectId');
            $object = app($objectType)->where('uuid', $objectId)->first();

            $list = \NextDeveloper\Commons\Database\Models\TaskSchedulers::where('object_type', '=', $objectType)
                ->where('object_id', '=', $object->id)
                ->get();

            return $list;
        }

        return parent::get($filter, $params);
    }

    public static function create($data)
    {
        if(array_key_exists('common_available_action_id', $data)) {
            $availableAction = \NextDeveloper\Commons\Database\Models\AvailableActions::where('uuid', $data['common_available_action_id'])->first();

            $data['common_available_action_id'] = $availableAction->id;
        }

        if(array_key_exists('day_of_week', $data)) {
            if($data['day_of_week'] < 0 || $data['day_of_week'] > 6) {
                unset($data['day_of_week']);
            }
        }

        if(array_key_exists('day_of_month', $data)) {
            if($data['day_of_month'] < 1 || $data['day_of_month'] > 31) {
                unset($data['day_of_month']);
            }
        }

        if($data['schedule_type'] == 'cron') {
            if(!array_key_exists('cron_expression', $data)) {
                throw new \Exception("When schedule_type is cron, you must provide cron_expression.");
            }

            unset($data['day_of_month']);
            unset($data['day_of_week']);
            unset($data['time_of_day']);

            $cron = new CronExpression($data['cron_expression']);
            $data['next_run_at'] = $cron->getNextRunDate();
        }

        if(array_key_exists('params', $data)) {
            //  This is a fix for Postman. When we are sending arrays, they are being converted to objects.
            if(!is_array($data['params'])) {
                $data['params'] = json_decode($data['params'], true);
            }

            foreach ($data['params'] as $param) {
                if(array_key_exists('action_name', $param)) {
                    $availableAction = \NextDeveloper\Commons\Database\Models\AvailableActions::where('name', $param['action_name'])
                        ->where('input', $data['object_type'])
                        ->first();

                    if($availableAction)
                        $data['common_available_action_id'] = $availableAction->id;
                    else
                        throw new \Exception("The action with name {$param['action_name']} does not exist" .
                            " for the object type {$data['object_type']}.");
                }
            }
        }

        if(array_key_exists('object_type', $data)) {
            if(!array_key_exists('object_id', $data)) {
                throw new \Exception("When you are creating by object_type, you must provide also object_id.");
            }

            $objectType = $data['object_type'];
            $objectType = explode('\\', $objectType);
            $objectType = $objectType[0] . '\\' . $objectType[1] . '\\Database\\Models\\' . $objectType[2];

            $object = app($objectType)->where('uuid', $data['object_id'])->first();

            if($object) {
                $data['object_type'] = $objectType;
                $data['object_id'] = $object->id;
            } else {
                throw new \Exception("The object with UUID {$data['object_id']} does not exist.");
            }
        }

        if(!array_key_exists('common_available_action_id', $data)) {
            throw new \Exception("You must provide common_available_action_id or params with action_name.");
        }

        return parent::create($data);
    }
}
