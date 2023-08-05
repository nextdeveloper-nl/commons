<?php

namespace NextDeveloper\Commons\Services\AbstractServices;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use NextDeveloper\Commons\Database\Models\CommonRegistry;
use NextDeveloper\Commons\Database\Filters\CommonRegistryQueryFilter;

use NextDeveloper\Commons\Events\CommonRegistry\CommonRegistryCreatedEvent;
use NextDeveloper\Commons\Events\CommonRegistry\CommonRegistryCreatingEvent;
use NextDeveloper\Commons\Events\CommonRegistry\CommonRegistryUpdatedEvent;
use NextDeveloper\Commons\Events\CommonRegistry\CommonRegistryUpdatingEvent;
use NextDeveloper\Commons\Events\CommonRegistry\CommonRegistryDeletedEvent;
use NextDeveloper\Commons\Events\CommonRegistry\CommonRegistryDeletingEvent;

/**
* This class is responsible from managing the data for CommonRegistry
*
* Class CommonRegistryService.
*
* @package NextDeveloper\Commons\Database\Models
*/
class AbstractCommonRegistryService {
    public static function get(CommonRegistryQueryFilter $filter = null, array $params = []) : Collection|LengthAwarePaginator {
        $enablePaginate = array_key_exists('paginate', $params);

        /**
        * Here we are adding null request since if filter is null, this means that this function is called from
        * non http application. This is actually not I think its a correct way to handle this problem but it's a workaround.
        *
        * Please let me know if you have any other idea about this; baris.bulut@nextdeveloper.com
        */
        if($filter == null)
            $filter = new CommonRegistryQueryFilter(new Request());

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

        $model = CommonRegistry::filter($filter);

        if($model && $enablePaginate)
            return $model->paginate($perPage);
        else
            return $model->get();
    }

    public static function getAll() {
        return CommonRegistry::all();
    }

    /**
    * This method returns the model by looking at reference id
    *
    * @param $ref
    * @return mixed
    */
    public static function getByRef($ref) : ?CommonRegistry {
        return CommonRegistry::findByRef($ref);
    }

    /**
    * This method returns the model by lookint at its id
    *
    * @param $id
    * @return CommonRegistry|null
    */
    public static function getById($id) : ?CommonRegistry {
        return CommonRegistry::where('id', $id)->first();
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
        event( new CommonRegistryCreatingEvent() );

		
	
        try {
            $model = CommonRegistry::create($data);
        } catch(\Exception $e) {
            throw $e;
        }

        event( new CommonRegistryCreatedEvent($model) );

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
        $model = CommonRegistry::where('uuid', $id)->first();

        event( new CommonRegistriesUpdateingEvent($model) );

        try {
           $model = $model->update($data);
        } catch(\Exception $e) {
           throw $e;
        }

        event( new CommonRegistriesUpdatedEvent($model) );

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
        $model = CommonRegistry::where('uuid', $id)->first();

        event( new CommonRegistriesDeletingEvent() );

        try {
            $model = $model->delete();
        } catch(\Exception $e) {
            throw $e;
        }

        event( new CommonRegistriesDeletedEvent($model) );

        return $model;
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
