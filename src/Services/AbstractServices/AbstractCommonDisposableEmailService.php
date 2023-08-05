<?php

namespace NextDeveloper\Commons\Services\AbstractServices;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use NextDeveloper\Commons\Database\Models\CommonDisposableEmail;
use NextDeveloper\Commons\Database\Filters\CommonDisposableEmailQueryFilter;

use NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailCreatedEvent;
use NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailCreatingEvent;
use NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailUpdatedEvent;
use NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailUpdatingEvent;
use NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailDeletedEvent;
use NextDeveloper\Commons\Events\CommonDisposableEmail\CommonDisposableEmailDeletingEvent;

/**
* This class is responsible from managing the data for CommonDisposableEmail
*
* Class CommonDisposableEmailService.
*
* @package NextDeveloper\Commons\Database\Models
*/
class AbstractCommonDisposableEmailService {
    public static function get(CommonDisposableEmailQueryFilter $filter = null, array $params = []) : Collection|LengthAwarePaginator {
        $enablePaginate = array_key_exists('paginate', $params);

        /**
        * Here we are adding null request since if filter is null, this means that this function is called from
        * non http application. This is actually not I think its a correct way to handle this problem but it's a workaround.
        *
        * Please let me know if you have any other idea about this; baris.bulut@nextdeveloper.com
        */
        if($filter == null)
            $filter = new CommonDisposableEmailQueryFilter(new Request());

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

        $model = CommonDisposableEmail::filter($filter);

        if($model && $enablePaginate)
            return $model->paginate($perPage);
        else
            return $model->get();
    }

    public static function getAll() {
        return CommonDisposableEmail::all();
    }

    /**
    * This method returns the model by looking at reference id
    *
    * @param $ref
    * @return mixed
    */
    public static function getByRef($ref) : ?CommonDisposableEmail {
        return CommonDisposableEmail::findByRef($ref);
    }

    /**
    * This method returns the model by lookint at its id
    *
    * @param $id
    * @return CommonDisposableEmail|null
    */
    public static function getById($id) : ?CommonDisposableEmail {
        return CommonDisposableEmail::where('id', $id)->first();
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
        event( new CommonDisposableEmailCreatingEvent() );

		
	
        try {
            $model = CommonDisposableEmail::create($data);
        } catch(\Exception $e) {
            throw $e;
        }

        event( new CommonDisposableEmailCreatedEvent($model) );

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
        $model = CommonDisposableEmail::where('uuid', $id)->first();

        event( new CommonDisposableEmailsUpdateingEvent($model) );

        try {
           $model = $model->update($data);
        } catch(\Exception $e) {
           throw $e;
        }

        event( new CommonDisposableEmailsUpdatedEvent($model) );

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
        $model = CommonDisposableEmail::where('uuid', $id)->first();

        event( new CommonDisposableEmailsDeletingEvent() );

        try {
            $model = $model->delete();
        } catch(\Exception $e) {
            throw $e;
        }

        event( new CommonDisposableEmailsDeletedEvent($model) );

        return $model;
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
