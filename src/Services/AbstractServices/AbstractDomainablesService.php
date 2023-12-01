<?php

namespace NextDeveloper\Commons\Services\AbstractServices;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use NextDeveloper\IAM\Helpers\UserHelper;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Helpers\DatabaseHelper;
use NextDeveloper\Commons\Database\Models\Domainables;
use NextDeveloper\Commons\Database\Filters\DomainablesQueryFilter;
use NextDeveloper\Commons\Events\Domainables\DomainablesCreatedEvent;
use NextDeveloper\Commons\Events\Domainables\DomainablesCreatingEvent;
use NextDeveloper\Commons\Events\Domainables\DomainablesUpdatedEvent;
use NextDeveloper\Commons\Events\Domainables\DomainablesUpdatingEvent;
use NextDeveloper\Commons\Events\Domainables\DomainablesDeletedEvent;
use NextDeveloper\Commons\Events\Domainables\DomainablesDeletingEvent;


/**
 * This class is responsible from managing the data for Domainables
 *
 * Class DomainablesService.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class AbstractDomainablesService
{
    public static function get(DomainablesQueryFilter $filter = null, array $params = []) : Collection|LengthAwarePaginator
    {
        $enablePaginate = array_key_exists('paginate', $params);

        /**
        * Here we are adding null request since if filter is null, this means that this function is called from
        * non http application. This is actually not I think its a correct way to handle this problem but it's a workaround.
        *
        * Please let me know if you have any other idea about this; baris.bulut@nextdeveloper.com
        */
        if($filter == null) {
            $filter = new DomainablesQueryFilter(new Request());
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

        $model = Domainables::filter($filter);

        if($model && $enablePaginate) {
            return $model->paginate($perPage);
        } else {
            return $model->get();
        }
    }

    public static function getAll()
    {
        return Domainables::all();
    }

    /**
     * This method returns the model by looking at reference id
     *
     * @param  $ref
     * @return mixed
     */
    public static function getByRef($ref) : ?Domainables
    {
        return Domainables::findByRef($ref);
    }

    /**
     * This method returns the model by lookint at its id
     *
     * @param  $id
     * @return Domainables|null
     */
    public static function getById($id) : ?Domainables
    {
        return Domainables::where('id', $id)->first();
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
        event(new DomainablesCreatingEvent());

        
        try {
            $model = Domainables::create($data);
        } catch(\Exception $e) {
            throw $e;
        }

        event(new DomainablesCreatedEvent($model));

        return $model->fresh();
    }

    /**
     This function expects the ID inside the object.
    
     @param  array $data
     @return Domainables
     */
    public static function updateRaw(array $data) : ?Domainables
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
        $model = Domainables::where('uuid', $id)->first();

        
        event(new DomainablesUpdatingEvent($model));

        try {
            $isUpdated = $model->update($data);
            $model = $model->fresh();
        } catch(\Exception $e) {
            throw $e;
        }

        event(new DomainablesUpdatedEvent($model));

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
    public static function delete($id)
    {
        $model = Domainables::where('uuid', $id)->first();

        event(new DomainablesDeletingEvent());

        try {
            $model = $model->delete();
        } catch(\Exception $e) {
            throw $e;
        }

        return $model;
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
