<?php

namespace NextDeveloper\Commons\Services\AbstractServices;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use NextDeveloper\IAM\Helpers\UserHelper;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Helpers\DatabaseHelper;
use NextDeveloper\Commons\Database\Models\Currencies;
use NextDeveloper\Commons\Database\Filters\CurrenciesQueryFilter;
use NextDeveloper\Commons\Events\Currencies\CurrenciesCreatedEvent;
use NextDeveloper\Commons\Events\Currencies\CurrenciesCreatingEvent;
use NextDeveloper\Commons\Events\Currencies\CurrenciesUpdatedEvent;
use NextDeveloper\Commons\Events\Currencies\CurrenciesUpdatingEvent;
use NextDeveloper\Commons\Events\Currencies\CurrenciesDeletedEvent;
use NextDeveloper\Commons\Events\Currencies\CurrenciesDeletingEvent;


/**
 * This class is responsible from managing the data for Currencies
 *
 * Class CurrenciesService.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class AbstractCurrenciesService
{
    public static function get(CurrenciesQueryFilter $filter = null, array $params = []) : Collection|LengthAwarePaginator
    {
        $enablePaginate = array_key_exists('paginate', $params);

        /**
        * Here we are adding null request since if filter is null, this means that this function is called from
        * non http application. This is actually not I think its a correct way to handle this problem but it's a workaround.
        *
        * Please let me know if you have any other idea about this; baris.bulut@nextdeveloper.com
        */
        if($filter == null) {
            $filter = new CurrenciesQueryFilter(new Request());
        }

        $perPage = config('commons.pagination.per_page');

        if($perPage == null) {
            $perPage = 20;
        }

        if(array_key_exists('per_page', $params)) {
            $perPage = intval($params['per_page']);

            if($perPage == 0) {
                $perPage = 20;
            }
        }

        if(array_key_exists('orderBy', $params)) {
            $filter->orderBy($params['orderBy']);
        }

        $model = Currencies::filter($filter);

        if($model && $enablePaginate) {
            return $model->paginate($perPage);
        } else {
            return $model->get();
        }
    }

    public static function getAll()
    {
        return Currencies::all();
    }

    /**
     * This method returns the model by looking at reference id
     *
     * @param  $ref
     * @return mixed
     */
    public static function getByRef($ref) : ?Currencies
    {
        return Currencies::findByRef($ref);
    }

    /**
     * This method returns the model by lookint at its id
     *
     * @param  $id
     * @return Currencies|null
     */
    public static function getById($id) : ?Currencies
    {
        return Currencies::where('id', $id)->first();
    }

    /**
     * This method created the model from an array.
     *
     * Throws an exception if stuck with any problem.
     *
     * @param  array $data
     * @return mixed
     * @throw  Exception
     */
    public static function create(array $data)
    {
        event(new CurrenciesCreatingEvent());

        if (array_key_exists('common_country_id', $data)) {
            $data['common_country_id'] = DatabaseHelper::uuidToId(
                '\NextDeveloper\Commons\Database\Models\Countries',
                $data['common_country_id']
            );
        }
            
        try {
            $model = Currencies::create($data);
        } catch(\Exception $e) {
            throw $e;
        }

        event(new CurrenciesCreatedEvent($model));

        return $model->fresh();
    }

    /**
     This function expects the ID inside the object.
    
     @param  array $data
     @return Currencies
     */
    public static function updateRaw(array $data) : ?Currencies
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
     * @param  array $data
     * @return mixed
     * @throw  Exception
     */
    public static function update($id, array $data)
    {
        $model = Currencies::where('uuid', $id)->first();

        if (array_key_exists('common_country_id', $data)) {
            $data['common_country_id'] = DatabaseHelper::uuidToId(
                '\NextDeveloper\Commons\Database\Models\Countries',
                $data['common_country_id']
            );
        }
    
        event(new CurrenciesUpdatingEvent($model));

        try {
            $isUpdated = $model->update($data);
            $model = $model->fresh();
        } catch(\Exception $e) {
            throw $e;
        }

        event(new CurrenciesUpdatedEvent($model));

        return $model->fresh();
    }

    /**
     * This method updated the model from an array.
     *
     * Throws an exception if stuck with any problem.
     *
     * @param
     * @param  array $data
     * @return mixed
     * @throw  Exception
     */
    public static function delete($id, array $data)
    {
        $model = Currencies::where('uuid', $id)->first();

        event(new CurrenciesDeletingEvent());

        try {
            $model = $model->delete();
        } catch(\Exception $e) {
            throw $e;
        }

        event(new CurrenciesDeletedEvent($model));

        return $model;
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
