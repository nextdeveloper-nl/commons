<?php

namespace NextDeveloper\Commons\Services\AbstractServices;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use NextDeveloper\Commons\Database\Models\CommonDomainable;
use NextDeveloper\Commons\Database\Filters\CommonDomainableQueryFilter;

use NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableCreatedEvent;
use NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableCreatingEvent;
use NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableUpdatedEvent;
use NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableUpdatingEvent;
use NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableDeletedEvent;
use NextDeveloper\Commons\Events\CommonDomainable\CommonDomainableDeletingEvent;

/**
* This class is responsible from managing the data for CommonDomainable
*
* Class CommonDomainableService.
*
* @package NextDeveloper\Commons\Database\Models
*/
class AbstractCommonDomainableService {
    public static function get(CommonDomainableQueryFilter $filter = null, array $params = []) : Collection|LengthAwarePaginator {
        $enablePaginate = array_key_exists('paginate', $params);

        /**
        * Here we are adding null request since if filter is null, this means that this function is called from
        * non http application. This is actually not I think its a correct way to handle this problem but it's a workaround.
        *
        * Please let me know if you have any other idea about this; baris.bulut@nextdeveloper.com
        */
        if($filter == null)
            $filter = new CommonDomainableQueryFilter(new Request());

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

        $model = CommonDomainable::filter($filter);

        if($model && $enablePaginate)
            return $model->paginate($perPage);
        else
            return $model->get();
    }

    public static function getAll() {
        return CommonDomainable::all();
    }

    /**
    * This method returns the model by looking at reference id
    *
    * @param $ref
    * @return mixed
    */
    public static function getByRef($ref) : ?CommonDomainable {
        return CommonDomainable::findByRef($ref);
    }

    /**
    * This method returns the model by lookint at its id
    *
    * @param $id
    * @return CommonDomainable|null
    */
    public static function getById($id) : ?CommonDomainable {
        return CommonDomainable::where('id', $id)->first();
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
        event( new CommonDomainableCreatingEvent() );

		
	
        try {
            $model = CommonDomainable::create($data);
        } catch(\Exception $e) {
            throw $e;
        }

        event( new CommonDomainableCreatedEvent($model) );

        return $model;
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
        $model = CommonDomainable::where('uuid', $id)->first();

        event( new CommonDomainablesUpdateingEvent($model) );

        try {
           $model = $model->update($data);
        } catch(\Exception $e) {
           throw $e;
        }

        event( new CommonDomainablesUpdatedEvent($model) );

        return $model;
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
        $model = CommonDomainable::where('uuid', $id)->first();

        event( new CommonDomainablesDeletingEvent() );

        try {
            $model = $model->delete();
        } catch(\Exception $e) {
            throw $e;
        }

        event( new CommonDomainablesDeletedEvent($model) );

        return $model;
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
