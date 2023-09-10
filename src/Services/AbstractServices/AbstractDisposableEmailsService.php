<?php

namespace NextDeveloper\Commons\Services\AbstractServices;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use NextDeveloper\IAM\Helpers\UserHelper;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Helpers\DatabaseHelper;
use NextDeveloper\Commons\Database\Models\DisposableEmails;
use NextDeveloper\Commons\Database\Filters\DisposableEmailsQueryFilter;
use NextDeveloper\Commons\Events\DisposableEmails\DisposableEmailsCreatedEvent;
use NextDeveloper\Commons\Events\DisposableEmails\DisposableEmailsCreatingEvent;
use NextDeveloper\Commons\Events\DisposableEmails\DisposableEmailsUpdatedEvent;
use NextDeveloper\Commons\Events\DisposableEmails\DisposableEmailsUpdatingEvent;
use NextDeveloper\Commons\Events\DisposableEmails\DisposableEmailsDeletedEvent;
use NextDeveloper\Commons\Events\DisposableEmails\DisposableEmailsDeletingEvent;


/**
* This class is responsible from managing the data for DisposableEmails
*
* Class DisposableEmailsService.
*
* @package NextDeveloper\Commons\Database\Models
*/
class AbstractDisposableEmailsService {
    public static function get(DisposableEmailsQueryFilter $filter = null, array $params = []) : Collection|LengthAwarePaginator {
        $enablePaginate = array_key_exists('paginate', $params);

        /**
        * Here we are adding null request since if filter is null, this means that this function is called from
        * non http application. This is actually not I think its a correct way to handle this problem but it's a workaround.
        *
        * Please let me know if you have any other idea about this; baris.bulut@nextdeveloper.com
        */
        if($filter == null)
            $filter = new DisposableEmailsQueryFilter(new Request());

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

        $model = DisposableEmails::filter($filter);

        if($model && $enablePaginate)
            return $model->paginate($perPage);
        else
            return $model->get();
    }

    public static function getAll() {
        return DisposableEmails::all();
    }

    /**
    * This method returns the model by looking at reference id
    *
    * @param $ref
    * @return mixed
    */
    public static function getByRef($ref) : ?DisposableEmails {
        return DisposableEmails::findByRef($ref);
    }

    /**
    * This method returns the model by lookint at its id
    *
    * @param $id
    * @return DisposableEmails|null
    */
    public static function getById($id) : ?DisposableEmails {
        return DisposableEmails::where('id', $id)->first();
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
        event( new DisposableEmailCreatingEvent() );

                if (array_key_exists('common_domain_id', $data))
            $data['common_domain_id'] = DatabaseHelper::uuidToId(
                '\NextDeveloper\Commons\Database\Models\Domain',
                $data['common_domain_id']
            );
	        
        try {
            $model = DisposableEmails::create($data);
        } catch(\Exception $e) {
            throw $e;
        }

        event( new DisposableEmailsCreatedEvent($model) );

        return $model->fresh();
    }

/**
* This function expects the ID inside the object.
*
* @param array $data
* @return DisposableEmails
*/
public static function updateRaw(array $data) : ?DisposableEmails
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
        $model = DisposableEmails::where('uuid', $id)->first();

                if (array_key_exists('common_domain_id', $data))
            $data['common_domain_id'] = DatabaseHelper::uuidToId(
                '\NextDeveloper\Commons\Database\Models\Domain',
                $data['common_domain_id']
            );
	
        event( new DisposableEmailsUpdatingEvent($model) );

        try {
           $isUpdated = $model->update($data);
           $model = $model->fresh();
        } catch(\Exception $e) {
           throw $e;
        }

        event( new DisposableEmailsUpdatedEvent($model) );

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
        $model = DisposableEmails::where('uuid', $id)->first();

        event( new DisposableEmailsDeletingEvent() );

        try {
            $model = $model->delete();
        } catch(\Exception $e) {
            throw $e;
        }

        event( new DisposableEmailsDeletedEvent($model) );

        return $model;
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
