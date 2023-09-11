<?php

namespace NextDeveloper\Commons\Services\AbstractServices;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use NextDeveloper\IAM\Helpers\UserHelper;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Helpers\DatabaseHelper;
use NextDeveloper\Commons\Database\Models\ExchangeRates;
use NextDeveloper\Commons\Database\Filters\ExchangeRatesQueryFilter;
use NextDeveloper\Commons\Events\ExchangeRates\ExchangeRatesCreatedEvent;
use NextDeveloper\Commons\Events\ExchangeRates\ExchangeRatesCreatingEvent;
use NextDeveloper\Commons\Events\ExchangeRates\ExchangeRatesUpdatedEvent;
use NextDeveloper\Commons\Events\ExchangeRates\ExchangeRatesUpdatingEvent;
use NextDeveloper\Commons\Events\ExchangeRates\ExchangeRatesDeletedEvent;
use NextDeveloper\Commons\Events\ExchangeRates\ExchangeRatesDeletingEvent;


/**
* This class is responsible from managing the data for ExchangeRates
*
* Class ExchangeRatesService.
*
* @package NextDeveloper\Commons\Database\Models
*/
class AbstractExchangeRatesService {
    public static function get(ExchangeRatesQueryFilter $filter = null, array $params = []) : Collection|LengthAwarePaginator {
        $enablePaginate = array_key_exists('paginate', $params);

        /**
        * Here we are adding null request since if filter is null, this means that this function is called from
        * non http application. This is actually not I think its a correct way to handle this problem but it's a workaround.
        *
        * Please let me know if you have any other idea about this; baris.bulut@nextdeveloper.com
        */
        if($filter == null)
            $filter = new ExchangeRatesQueryFilter(new Request());

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

        $model = ExchangeRates::filter($filter);

        if($model && $enablePaginate)
            return $model->paginate($perPage);
        else
            return $model->get();
    }

    public static function getAll() {
        return ExchangeRates::all();
    }

    /**
    * This method returns the model by looking at reference id
    *
    * @param $ref
    * @return mixed
    */
    public static function getByRef($ref) : ?ExchangeRates {
        return ExchangeRates::findByRef($ref);
    }

    /**
    * This method returns the model by lookint at its id
    *
    * @param $id
    * @return ExchangeRates|null
    */
    public static function getById($id) : ?ExchangeRates {
        return ExchangeRates::where('id', $id)->first();
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
        event( new ExchangeRateCreatingEvent() );

                if (array_key_exists('common_country_id', $data))
            $data['common_country_id'] = DatabaseHelper::uuidToId(
                '\NextDeveloper\Commons\Database\Models\Country',
                $data['common_country_id']
            );
	        
        try {
            $model = ExchangeRates::create($data);
        } catch(\Exception $e) {
            throw $e;
        }

        event( new ExchangeRatesCreatedEvent($model) );

        return $model->fresh();
    }

/**
* This function expects the ID inside the object.
*
* @param array $data
* @return ExchangeRates
*/
public static function updateRaw(array $data) : ?ExchangeRates
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
        $model = ExchangeRates::where('uuid', $id)->first();

                if (array_key_exists('common_country_id', $data))
            $data['common_country_id'] = DatabaseHelper::uuidToId(
                '\NextDeveloper\Commons\Database\Models\Country',
                $data['common_country_id']
            );
	
        event( new ExchangeRatesUpdatingEvent($model) );

        try {
           $isUpdated = $model->update($data);
           $model = $model->fresh();
        } catch(\Exception $e) {
           throw $e;
        }

        event( new ExchangeRatesUpdatedEvent($model) );

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
        $model = ExchangeRates::where('uuid', $id)->first();

        event( new ExchangeRatesDeletingEvent() );

        try {
            $model = $model->delete();
        } catch(\Exception $e) {
            throw $e;
        }

        event( new ExchangeRatesDeletedEvent($model) );

        return $model;
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}