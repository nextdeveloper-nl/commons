<?php

namespace NextDeveloper\Commons\Services\AbstractServices;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use NextDeveloper\IAM\Helpers\UserHelper;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Helpers\DatabaseHelper;
use NextDeveloper\Commons\Database\Models\Media;
use NextDeveloper\Commons\Database\Filters\MediaQueryFilter;
use NextDeveloper\Commons\Events\Media\MediaCreatedEvent;
use NextDeveloper\Commons\Events\Media\MediaCreatingEvent;
use NextDeveloper\Commons\Events\Media\MediaUpdatedEvent;
use NextDeveloper\Commons\Events\Media\MediaUpdatingEvent;
use NextDeveloper\Commons\Events\Media\MediaDeletedEvent;
use NextDeveloper\Commons\Events\Media\MediaDeletingEvent;


/**
* This class is responsible from managing the data for Media
*
* Class MediaService.
*
* @package NextDeveloper\Commons\Database\Models
*/
class AbstractMediaService {
    public static function get(MediaQueryFilter $filter = null, array $params = []) : Collection|LengthAwarePaginator {
        $enablePaginate = array_key_exists('paginate', $params);

        /**
        * Here we are adding null request since if filter is null, this means that this function is called from
        * non http application. This is actually not I think its a correct way to handle this problem but it's a workaround.
        *
        * Please let me know if you have any other idea about this; baris.bulut@nextdeveloper.com
        */
        if($filter == null)
            $filter = new MediaQueryFilter(new Request());

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

        $model = Media::filter($filter);

        if($model && $enablePaginate)
            return $model->paginate($perPage);
        else
            return $model->get();
    }

    public static function getAll() {
        return Media::all();
    }

    /**
    * This method returns the model by looking at reference id
    *
    * @param $ref
    * @return mixed
    */
    public static function getByRef($ref) : ?Media {
        return Media::findByRef($ref);
    }

    /**
    * This method returns the model by lookint at its id
    *
    * @param $id
    * @return Media|null
    */
    public static function getById($id) : ?Media {
        return Media::where('id', $id)->first();
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
        event( new MediumCreatingEvent() );

                if (array_key_exists('mediable_id', $data))
            $data['mediable_id'] = DatabaseHelper::uuidToId(
                '\NextDeveloper\\Database\Models\Mediable',
                $data['mediable_id']
            );
	        
        try {
            $model = Media::create($data);
        } catch(\Exception $e) {
            throw $e;
        }

        event( new MediaCreatedEvent($model) );

        return $model->fresh();
    }

/**
* This function expects the ID inside the object.
*
* @param array $data
* @return Media
*/
public static function updateRaw(array $data) : ?Media
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
        $model = Media::where('uuid', $id)->first();

                if (array_key_exists('mediable_id', $data))
            $data['mediable_id'] = DatabaseHelper::uuidToId(
                '\NextDeveloper\\Database\Models\Mediable',
                $data['mediable_id']
            );
	
        event( new MediaUpdatingEvent($model) );

        try {
           $isUpdated = $model->update($data);
           $model = $model->fresh();
        } catch(\Exception $e) {
           throw $e;
        }

        event( new MediaUpdatedEvent($model) );

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
        $model = Media::where('uuid', $id)->first();

        event( new MediaDeletingEvent() );

        try {
            $model = $model->delete();
        } catch(\Exception $e) {
            throw $e;
        }

        event( new MediaDeletedEvent($model) );

        return $model;
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}