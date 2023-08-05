<?php

namespace NextDeveloper\Commons\Services\AbstractServices;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use NextDeveloper\Commons\Database\Models\CommonMedia;
use NextDeveloper\Commons\Database\Filters\CommonMediaQueryFilter;

use NextDeveloper\Commons\Events\CommonMedia\CommonMediaCreatedEvent;
use NextDeveloper\Commons\Events\CommonMedia\CommonMediaCreatingEvent;
use NextDeveloper\Commons\Events\CommonMedia\CommonMediaUpdatedEvent;
use NextDeveloper\Commons\Events\CommonMedia\CommonMediaUpdatingEvent;
use NextDeveloper\Commons\Events\CommonMedia\CommonMediaDeletedEvent;
use NextDeveloper\Commons\Events\CommonMedia\CommonMediaDeletingEvent;

/**
* This class is responsible from managing the data for CommonMedia
*
* Class CommonMediaService.
*
* @package NextDeveloper\Commons\Database\Models
*/
class AbstractCommonMediaService {
    public static function get(CommonMediaQueryFilter $filter = null, array $params = []) : Collection|LengthAwarePaginator {
        $enablePaginate = array_key_exists('paginate', $params);

        /**
        * Here we are adding null request since if filter is null, this means that this function is called from
        * non http application. This is actually not I think its a correct way to handle this problem but it's a workaround.
        *
        * Please let me know if you have any other idea about this; baris.bulut@nextdeveloper.com
        */
        if($filter == null)
            $filter = new CommonMediaQueryFilter(new Request());

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

        $model = CommonMedia::filter($filter);

        if($model && $enablePaginate)
            return $model->paginate($perPage);
        else
            return $model->get();
    }

    public static function getAll() {
        return CommonMedia::all();
    }

    /**
    * This method returns the model by looking at reference id
    *
    * @param $ref
    * @return mixed
    */
    public static function getByRef($ref) : ?CommonMedia {
        return CommonMedia::findByRef($ref);
    }

    /**
    * This method returns the model by lookint at its id
    *
    * @param $id
    * @return CommonMedia|null
    */
    public static function getById($id) : ?CommonMedia {
        return CommonMedia::where('id', $id)->first();
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
        event( new CommonMediaCreatingEvent() );

		
	
        try {
            $model = CommonMedia::create($data);
        } catch(\Exception $e) {
            throw $e;
        }

        event( new CommonMediaCreatedEvent($model) );

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
        $model = CommonMedia::where('uuid', $id)->first();

        event( new CommonMediaUpdateingEvent($model) );

        try {
           $model = $model->update($data);
        } catch(\Exception $e) {
           throw $e;
        }

        event( new CommonMediaUpdatedEvent($model) );

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
        $model = CommonMedia::where('uuid', $id)->first();

        event( new CommonMediaDeletingEvent() );

        try {
            $model = $model->delete();
        } catch(\Exception $e) {
            throw $e;
        }

        event( new CommonMediaDeletedEvent($model) );

        return $model;
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
