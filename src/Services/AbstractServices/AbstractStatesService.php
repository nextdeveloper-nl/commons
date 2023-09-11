<?php

namespace NextDeveloper\Commons\Services\AbstractServices;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use NextDeveloper\IAM\Helpers\UserHelper;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Helpers\DatabaseHelper;
use NextDeveloper\Commons\Database\Models\States;
use NextDeveloper\Commons\Database\Filters\StatesQueryFilter;
use NextDeveloper\Commons\Events\States\StatesCreatedEvent;
use NextDeveloper\Commons\Events\States\StatesCreatingEvent;
use NextDeveloper\Commons\Events\States\StatesUpdatedEvent;
use NextDeveloper\Commons\Events\States\StatesUpdatingEvent;
use NextDeveloper\Commons\Events\States\StatesDeletedEvent;
use NextDeveloper\Commons\Events\States\StatesDeletingEvent;


/**
* This class is responsible from managing the data for States
*
* Class StatesService.
*
* @package NextDeveloper\Commons\Database\Models
*/
class AbstractStatesService {
    public static function get(StatesQueryFilter $filter = null, array $params = []) : Collection|LengthAwarePaginator {
        $enablePaginate = array_key_exists('paginate', $params);

        /**
        * Here we are adding null request since if filter is null, this means that this function is called from
        * non http application. This is actually not I think its a correct way to handle this problem but it's a workaround.
        *
        * Please let me know if you have any other idea about this; baris.bulut@nextdeveloper.com
        */
        if($filter == null)
            $filter = new StatesQueryFilter(new Request());

        $perPage = config('commons.pagination.per_page');

        if($perPage == null)
            $perPage = 20;

        if(array_key_exists('per_page', $params)) {
            $perPage = intval($params['per_page']);

            if($perPage == 0)
                $perPage = 20;
        }

        if(array_key_exists('orderBy', $params)) {
            $filter->orderBy($params['orderBy']);
        }

        $model = States::filter($filter);

        if($model && $enablePaginate)
            return $model->paginate($perPage);
        else
            return $model->get();
    }

    public static function getAll() {
        return States::all();
    }

    /**
    * This method returns the model by looking at reference id
    *
    * @param $ref
    * @return mixed
    */
    public static function getByRef($ref) : ?States {
        return States::findByRef($ref);
    }

    /**
    * This method returns the model by lookint at its id
    *
    * @param $id
    * @return States|null
    */
    public static function getById($id) : ?States {
        return States::where('id', $id)->first();
    }

    /**
    * This method created the model from an array.
    *
    * Throws an exception if stuck with any problem.
    *
    * @param array $data
    * @return mixed
    * @throw Exception
    */
    public static function create(array $data) {
        event( new StateCreatingEvent() );

                if (array_key_exists('model_id', $data))
            $data['model_id'] = DatabaseHelper::uuidToId(
                '\NextDeveloper\\Database\Models\Model',
                $data['model_id']
            );
	        
        try {
            $model = States::create($data);
        } catch(\Exception $e) {
            throw $e;
        }

        event( new StatesCreatedEvent($model) );

        return $model->fresh();
    }

/**
* This function expects the ID inside the object.
*
* @param array $data
* @return States
*/
public static function updateRaw(array $data) : ?States
{
if(array_key_exists('id', $data)) {
return self::update($data['id'], $data);
}

return null;
}

    /**
    * This method updated the model from an array.
    *
    * Throws an exception if stuck with any problem.
    *
    * @param
    * @param array $data
    * @return mixed
    * @throw Exception
    */
    public static function update($id, array $data) {
        $model = States::where('uuid', $id)->first();

                if (array_key_exists('model_id', $data))
            $data['model_id'] = DatabaseHelper::uuidToId(
                '\NextDeveloper\\Database\Models\Model',
                $data['model_id']
            );
	
        event( new StatesUpdatingEvent($model) );

        try {
           $isUpdated = $model->update($data);
           $model = $model->fresh();
        } catch(\Exception $e) {
           throw $e;
        }

        event( new StatesUpdatedEvent($model) );

        return $model->fresh();
    }

    /**
    * This method updated the model from an array.
    *
    * Throws an exception if stuck with any problem.
    *
    * @param
    * @param array $data
    * @return mixed
    * @throw Exception
    */
    public static function delete($id, array $data) {
        $model = States::where('uuid', $id)->first();

        event( new StatesDeletingEvent() );

        try {
            $model = $model->delete();
        } catch(\Exception $e) {
            throw $e;
        }

        event( new StatesDeletedEvent($model) );

        return $model;
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}