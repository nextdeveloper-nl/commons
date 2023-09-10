<?php

namespace NextDeveloper\Commons\Services\AbstractServices;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use NextDeveloper\IAM\Helpers\UserHelper;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Helpers\DatabaseHelper;
use NextDeveloper\Commons\Database\Models\Taggables;
use NextDeveloper\Commons\Database\Filters\TaggablesQueryFilter;
use NextDeveloper\Commons\Events\Taggables\TaggablesCreatedEvent;
use NextDeveloper\Commons\Events\Taggables\TaggablesCreatingEvent;
use NextDeveloper\Commons\Events\Taggables\TaggablesUpdatedEvent;
use NextDeveloper\Commons\Events\Taggables\TaggablesUpdatingEvent;
use NextDeveloper\Commons\Events\Taggables\TaggablesDeletedEvent;
use NextDeveloper\Commons\Events\Taggables\TaggablesDeletingEvent;


/**
* This class is responsible from managing the data for Taggables
*
* Class TaggablesService.
*
* @package NextDeveloper\Commons\Database\Models
*/
class AbstractTaggablesService {
    public static function get(TaggablesQueryFilter $filter = null, array $params = []) : Collection|LengthAwarePaginator {
        $enablePaginate = array_key_exists('paginate', $params);

        /**
        * Here we are adding null request since if filter is null, this means that this function is called from
        * non http application. This is actually not I think its a correct way to handle this problem but it's a workaround.
        *
        * Please let me know if you have any other idea about this; baris.bulut@nextdeveloper.com
        */
        if($filter == null)
            $filter = new TaggablesQueryFilter(new Request());

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

        $model = Taggables::filter($filter);

        if($model && $enablePaginate)
            return $model->paginate($perPage);
        else
            return $model->get();
    }

    public static function getAll() {
        return Taggables::all();
    }

    /**
    * This method returns the model by looking at reference id
    *
    * @param $ref
    * @return mixed
    */
    public static function getByRef($ref) : ?Taggables {
        return Taggables::findByRef($ref);
    }

    /**
    * This method returns the model by lookint at its id
    *
    * @param $id
    * @return Taggables|null
    */
    public static function getById($id) : ?Taggables {
        return Taggables::where('id', $id)->first();
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
        event( new TaggableCreatingEvent() );

                if (array_key_exists('tag_id', $data))
            $data['tag_id'] = DatabaseHelper::uuidToId(
                '\NextDeveloper\\Database\Models\Tag',
                $data['tag_id']
            );
	        if (array_key_exists('taggable_id', $data))
            $data['taggable_id'] = DatabaseHelper::uuidToId(
                '\NextDeveloper\\Database\Models\Taggable',
                $data['taggable_id']
            );
	        
        try {
            $model = Taggables::create($data);
        } catch(\Exception $e) {
            throw $e;
        }

        event( new TaggablesCreatedEvent($model) );

        return $model->fresh();
    }

/**
* This function expects the ID inside the object.
*
* @param array $data
* @return Taggables
*/
public static function updateRaw(array $data) : ?Taggables
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
        $model = Taggables::where('uuid', $id)->first();

                if (array_key_exists('tag_id', $data))
            $data['tag_id'] = DatabaseHelper::uuidToId(
                '\NextDeveloper\\Database\Models\Tag',
                $data['tag_id']
            );
	        if (array_key_exists('taggable_id', $data))
            $data['taggable_id'] = DatabaseHelper::uuidToId(
                '\NextDeveloper\\Database\Models\Taggable',
                $data['taggable_id']
            );
	
        event( new TaggablesUpdatingEvent($model) );

        try {
           $isUpdated = $model->update($data);
           $model = $model->fresh();
        } catch(\Exception $e) {
           throw $e;
        }

        event( new TaggablesUpdatedEvent($model) );

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
        $model = Taggables::where('uuid', $id)->first();

        event( new TaggablesDeletingEvent() );

        try {
            $model = $model->delete();
        } catch(\Exception $e) {
            throw $e;
        }

        event( new TaggablesDeletedEvent($model) );

        return $model;
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
