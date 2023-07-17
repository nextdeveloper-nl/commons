<?php

namespace NextDeveloper\Commons\Services\AbstractServices;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use NextDeveloper\Commons\Database\Models\CommonExchangeRate;
use NextDeveloper\Commons\Database\Filters\CommonExchangeRateQueryFilter;

use NextDeveloper\Commons\Events\CommonExchangeRate\CommonExchangeRateCreatedEvent;
use NextDeveloper\Commons\Events\CommonExchangeRate\CommonExchangeRateCreatingEvent;

/**
* This class is responsible from managing the data for CommonExchangeRate
*
* Class CommonExchangeRateService.
*
* @package NextDeveloper\Commons\Database\Models
*/
class AbstractCommonExchangeRateService {
    public static function get(CommonExchangeRateQueryFilter $filter = null, array $params = []) : Collection|LengthAwarePaginator {
        $enablePaginate = array_key_exists('paginate', $params);

        /**
        * Here we are adding null request since if filter is null, this means that this function is called from
        * non http application. This is actually not I think its a correct way to handle this problem but it's a workaround.
        *
        * Please let me know if you have any other idea about this; baris.bulut@nextdeveloper.com
        */
        if($filter == null)
            $filter = new CommonExchangeRateQueryFilter(new Request());

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

        $model = CommonExchangeRate::filter($filter);

        if($model && $enablePaginate)
            return $model->paginate($perPage);
        else
            return $model->get();

        if(!$model && $enablePaginate)
            return CommonExchangeRate::paginate($perPage);
        else
            return CommonExchangeRate::get();
    }

    public static function getAll() {
        return CommonExchangeRate::all();
    }

    /**
    * This method returns the model by looking at reference id
    *
    * @param $ref
    * @return mixed
    */
    public static function getByRef($ref) : ?CommonExchangeRate {
        return CommonExchangeRate::findByRef($ref);
    }

    /**
    * This method returns the model by lookint at its id
    *
    * @param $id
    * @return CommonExchangeRate|null
    */
    public static function getById($id) : ?CommonExchangeRate {
        return CommonExchangeRate::where('id', $id)->first();
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
        event( new CommonExchangeRateCreatingEvent() );

        try {
            $model = CommonExchangeRate::create($data);
        } catch(\Exception $e) {
            throw $e;
        }

        event( new CommonExchangeRateCreatedEvent($model) );

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
        $model = CommonExchangeRate::where('uuid', $id)->first();

        event( new CommonExchangeRatesUpdateingEvent($model) );

        try {
           $model = $model->update($data);
        } catch(\Exception $e) {
           throw $e;
        }

        event( new CommonExchangeRatesUpdatedEvent($model) );

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
        $model = CommonExchangeRate::where('uuid', $id)->first();

        event( new CommonExchangeRatesDeletingEvent() );

        try {
            $model = $model->delete();
        } catch(\Exception $e) {
            throw $e;
        }

        event( new CommonExchangeRatesDeletedEvent($model) );

        return $model;
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}