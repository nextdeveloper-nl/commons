<?php

namespace NextDeveloper\Commons\Services\AbstractServices;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use NextDeveloper\IAM\Helpers\UserHelper;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Helpers\DatabaseHelper;
use NextDeveloper\Commons\Database\Models\SocialMedia;
use NextDeveloper\Commons\Database\Filters\SocialMediaQueryFilter;
use NextDeveloper\Commons\Events\SocialMedia\SocialMediaCreatedEvent;
use NextDeveloper\Commons\Events\SocialMedia\SocialMediaCreatingEvent;
use NextDeveloper\Commons\Events\SocialMedia\SocialMediaUpdatedEvent;
use NextDeveloper\Commons\Events\SocialMedia\SocialMediaUpdatingEvent;
use NextDeveloper\Commons\Events\SocialMedia\SocialMediaDeletedEvent;
use NextDeveloper\Commons\Events\SocialMedia\SocialMediaDeletingEvent;


/**
 * This class is responsible from managing the data for SocialMedia
 *
 * Class SocialMediaService.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class AbstractSocialMediaService
{
    public static function get(SocialMediaQueryFilter $filter = null, array $params = []) : Collection|LengthAwarePaginator
    {
        $enablePaginate = array_key_exists('paginate', $params);

        /**
        * Here we are adding null request since if filter is null, this means that this function is called from
        * non http application. This is actually not I think its a correct way to handle this problem but it's a workaround.
        *
        * Please let me know if you have any other idea about this; baris.bulut@nextdeveloper.com
        */
        if($filter == null) {
            $filter = new SocialMediaQueryFilter(new Request());
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

        $model = SocialMedia::filter($filter);

        if($model && $enablePaginate) {
            return $model->paginate($perPage);
        } else {
            return $model->get();
        }
    }

    public static function getAll()
    {
        return SocialMedia::all();
    }

    /**
     * This method returns the model by looking at reference id
     *
     * @param  $ref
     * @return mixed
     */
    public static function getByRef($ref) : ?SocialMedia
    {
        return SocialMedia::findByRef($ref);
    }

    /**
     * This method returns the model by lookint at its id
     *
     * @param  $id
     * @return SocialMedia|null
     */
    public static function getById($id) : ?SocialMedia
    {
        return SocialMedia::where('id', $id)->first();
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
        event(new SocialMediaCreatingEvent());

        
        try {
            $model = SocialMedia::create($data);
        } catch(\Exception $e) {
            throw $e;
        }

        event(new SocialMediaCreatedEvent($model));

        return $model->fresh();
    }

    /**
     This function expects the ID inside the object.
    
     @param  array $data
     @return SocialMedia
     */
    public static function updateRaw(array $data) : ?SocialMedia
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
        $model = SocialMedia::where('uuid', $id)->first();

        
        event(new SocialMediaUpdatingEvent($model));

        try {
            $isUpdated = $model->update($data);
            $model = $model->fresh();
        } catch(\Exception $e) {
            throw $e;
        }

        event(new SocialMediaUpdatedEvent($model));

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
        $model = SocialMedia::where('uuid', $id)->first();

        event(new SocialMediaDeletingEvent());

        try {
            $model = $model->delete();
        } catch(\Exception $e) {
            throw $e;
        }

        return $model;
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
