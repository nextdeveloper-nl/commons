<?php

namespace NextDeveloper\Commons\Services;

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
        $availableAction = \NextDeveloper\Commons\Database\Models\AvailableActions::where('uuid', $data['common_available_action_id'])->first();

        $data['common_available_action_id'] = $availableAction->id;

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

        return parent::create($data);
    }
}
