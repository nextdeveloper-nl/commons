<?php

namespace NextDeveloper\Commons\Services\AbstractServices;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use NextDeveloper\Commons\Database\Models\CommonLanguage;
use NextDeveloper\Commons\Database\Filters\CommonLanguageQueryFilter;

use NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageCreatedEvent;
use NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageCreatingEvent;
use NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageUpdatedEvent;
use NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageUpdatingEvent;
use NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageDeletedEvent;
use NextDeveloper\Commons\Events\CommonLanguage\CommonLanguageDeletingEvent;

/**
* This class is responsible from managing the data for CommonLanguage
*
* Class CommonLanguageService.
*
* @package NextDeveloper\Commons\Database\Models
*/
class AbstractCommonLanguageService {
    public static function get(CommonLanguageQueryFilter $filter = null, array $params = []) : Collection|LengthAwarePaginator {
        $enablePaginate = array_key_exists('paginate', $params);

        /**
        * Here we are adding null request since if filter is null, this means that this function is called from
        * non http application. This is actually not I think its a correct way to handle this problem but it's a workaround.
        *
        * Please let me know if you have any other idea about this; baris.bulut@nextdeveloper.com
        */
        if($filter == null)
            $filter = new CommonLanguageQueryFilter(new Request());

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

        $model = CommonLanguage::filter($filter);

        if($model && $enablePaginate)
            return $model->paginate($perPage);
        else
            return $model->get();
    }

    public static function getAll() {
        return CommonLanguage::all();
    }

    /**
    * This method returns the model by looking at reference id
    *
    * @param $ref
    * @return mixed
    */
    public static function getByRef($ref) : ?CommonLanguage {
        return CommonLanguage::findByRef($ref);
    }

    /**
    * This method returns the model by lookint at its id
    *
    * @param $id
    * @return CommonLanguage|null
    */
    public static function getById($id) : ?CommonLanguage {
        return CommonLanguage::where('id', $id)->first();
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
        event( new CommonLanguageCreatingEvent() );

		
	
        try {
            $model = CommonLanguage::create($data);
        } catch(\Exception $e) {
            throw $e;
        }

        event( new CommonLanguageCreatedEvent($model) );

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
        $model = CommonLanguage::where('uuid', $id)->first();

        event( new CommonLanguagesUpdateingEvent($model) );

        try {
           $model = $model->update($data);
        } catch(\Exception $e) {
           throw $e;
        }

        event( new CommonLanguagesUpdatedEvent($model) );

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
        $model = CommonLanguage::where('uuid', $id)->first();

        event( new CommonLanguagesDeletingEvent() );

        try {
            $model = $model->delete();
        } catch(\Exception $e) {
            throw $e;
        }

        event( new CommonLanguagesDeletedEvent($model) );

        return $model;
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
