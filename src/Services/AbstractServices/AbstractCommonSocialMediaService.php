<?php

namespace NextDeveloper\Commons\Services\AbstractServices;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use NextDeveloper\IAM\Helpers\UserHelper;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Helpers\DatabaseHelper;
use NextDeveloper\Commons\Database\Models\CommonSocialMedia;
use NextDeveloper\Commons\Database\Filters\CommonSocialMediaQueryFilter;
use NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaCreatedEvent;
use NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaCreatingEvent;
use NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaUpdatedEvent;
use NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaUpdatingEvent;
use NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaDeletedEvent;
use NextDeveloper\Commons\Events\CommonSocialMedia\CommonSocialMediaDeletingEvent;


/**
* This class is responsible from managing the data for CommonSocialMedia
*
* Class CommonSocialMediaService.
*
* @package NextDeveloper\Commons\Database\Models
*/
class AbstractCommonSocialMediaService {
    public static function get(CommonSocialMediaQueryFilter $filter = null, array $params = []) : Collection|LengthAwarePaginator {
        $enablePaginate = array_key_exists('paginate', $params);

        /**
        * Here we are adding null request since if filter is null, this means that this function is called from
        * non http application. This is actually not I think its a correct way to handle this problem but it's a workaround.
        *
        * Please let me know if you have any other idea about this; baris.bulut@nextdeveloper.com
        */
        if($filter == null)
            $filter = new CommonSocialMediaQueryFilter(new Request());

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

        $model = CommonSocialMedia::filter($filter);

        if($model && $enablePaginate)
            return $model->paginate($perPage);
        else
            return $model->get();
    }

    public static function getAll() {
        return CommonSocialMedia::all();
    }

    /**
    * This method returns the model by looking at reference id
    *
    * @param $ref
    * @return mixed
    */
    public static function getByRef($ref) : ?CommonSocialMedia {
        return CommonSocialMedia::findByRef($ref);
    }

    /**
    * This method returns the model by lookint at its id
    *
    * @param $id
    * @return CommonSocialMedia|null
    */
    public static function getById($id) : ?CommonSocialMedia {
        return CommonSocialMedia::where('id', $id)->first();
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
        event( new CommonSocialMediaCreatingEvent() );

                if (array_key_exists('sociable_id', $data))
            $data['sociable_id'] = DatabaseHelper::uuidToId(
                '\NextDeveloper\\Database\Models\Sociable',
                $data['sociable_id']
            );
	        
        try {
            $model = CommonSocialMedia::create($data);
        } catch(\Exception $e) {
            throw $e;
        }

        event( new CommonSocialMediaCreatedEvent($model) );

        return $model->fresh();
    }

/**
* This function expects the ID inside the object.
*
* @param array $data
* @return CommonSocialMedia
*/
public static function updateRaw(array $data) : ?CommonSocialMedia
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
        $model = CommonSocialMedia::where('uuid', $id)->first();

                if (array_key_exists('sociable_id', $data))
            $data['sociable_id'] = DatabaseHelper::uuidToId(
                '\NextDeveloper\\Database\Models\Sociable',
                $data['sociable_id']
            );
	
        event( new CommonSocialMediaUpdatingEvent($model) );

        try {
           $isUpdated = $model->update($data);
           $model = $model->fresh();
        } catch(\Exception $e) {
           throw $e;
        }

        event( new CommonSocialMediaUpdatedEvent($model) );

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
        $model = CommonSocialMedia::where('uuid', $id)->first();

        event( new CommonSocialMediaDeletingEvent() );

        try {
            $model = $model->delete();
        } catch(\Exception $e) {
            throw $e;
        }

        event( new CommonSocialMediaDeletedEvent($model) );

        return $model;
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
