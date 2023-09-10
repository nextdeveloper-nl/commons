<?php

namespace NextDeveloper\Commons\Services\AbstractServices;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use NextDeveloper\IAM\Helpers\UserHelper;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Helpers\DatabaseHelper;
use NextDeveloper\Commons\Database\Models\Categories;
use NextDeveloper\Commons\Database\Filters\CategoriesQueryFilter;
use NextDeveloper\Commons\Events\Categories\CategoriesCreatedEvent;
use NextDeveloper\Commons\Events\Categories\CategoriesCreatingEvent;
use NextDeveloper\Commons\Events\Categories\CategoriesUpdatedEvent;
use NextDeveloper\Commons\Events\Categories\CategoriesUpdatingEvent;
use NextDeveloper\Commons\Events\Categories\CategoriesDeletedEvent;
use NextDeveloper\Commons\Events\Categories\CategoriesDeletingEvent;


/**
* This class is responsible from managing the data for Categories
*
* Class CategoriesService.
*
* @package NextDeveloper\Commons\Database\Models
*/
class AbstractCategoriesService {
    public static function get(CategoriesQueryFilter $filter = null, array $params = []) : Collection|LengthAwarePaginator {
        $enablePaginate = array_key_exists('paginate', $params);

        /**
        * Here we are adding null request since if filter is null, this means that this function is called from
        * non http application. This is actually not I think its a correct way to handle this problem but it's a workaround.
        *
        * Please let me know if you have any other idea about this; baris.bulut@nextdeveloper.com
        */
        if($filter == null)
            $filter = new CategoriesQueryFilter(new Request());

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

        $model = Categories::filter($filter);

        if($model && $enablePaginate)
            return $model->paginate($perPage);
        else
            return $model->get();
    }

    public static function getAll() {
        return Categories::all();
    }

    /**
    * This method returns the model by looking at reference id
    *
    * @param $ref
    * @return mixed
    */
    public static function getByRef($ref) : ?Categories {
        return Categories::findByRef($ref);
    }

    /**
    * This method returns the model by lookint at its id
    *
    * @param $id
    * @return Categories|null
    */
    public static function getById($id) : ?Categories {
        return Categories::where('id', $id)->first();
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
        event( new CategoryCreatingEvent() );

                if (array_key_exists('common_domain_id', $data))
            $data['common_domain_id'] = DatabaseHelper::uuidToId(
                '\NextDeveloper\Commons\Database\Models\Domain',
                $data['common_domain_id']
            );
	        if (array_key_exists('common_categories_id', $data))
            $data['common_categories_id'] = DatabaseHelper::uuidToId(
                '\NextDeveloper\Commons\Database\Models\Category',
                $data['common_categories_id']
            );
	        
        try {
            $model = Categories::create($data);
        } catch(\Exception $e) {
            throw $e;
        }

        event( new CategoriesCreatedEvent($model) );

        return $model->fresh();
    }

/**
* This function expects the ID inside the object.
*
* @param array $data
* @return Categories
*/
public static function updateRaw(array $data) : ?Categories
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
        $model = Categories::where('uuid', $id)->first();

                if (array_key_exists('common_domain_id', $data))
            $data['common_domain_id'] = DatabaseHelper::uuidToId(
                '\NextDeveloper\Commons\Database\Models\Domain',
                $data['common_domain_id']
            );
	        if (array_key_exists('common_categories_id', $data))
            $data['common_categories_id'] = DatabaseHelper::uuidToId(
                '\NextDeveloper\Commons\Database\Models\Category',
                $data['common_categories_id']
            );
	
        event( new CategoriesUpdatingEvent($model) );

        try {
           $isUpdated = $model->update($data);
           $model = $model->fresh();
        } catch(\Exception $e) {
           throw $e;
        }

        event( new CategoriesUpdatedEvent($model) );

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
        $model = Categories::where('uuid', $id)->first();

        event( new CategoriesDeletingEvent() );

        try {
            $model = $model->delete();
        } catch(\Exception $e) {
            throw $e;
        }

        event( new CategoriesDeletedEvent($model) );

        return $model;
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
