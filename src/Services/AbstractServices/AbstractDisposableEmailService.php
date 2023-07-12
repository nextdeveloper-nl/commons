<?php

namespace NextDeveloper\Commons\Services\AbstractServices;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use NextDeveloper\Commons\Database\Models\DisposableEmail;
use NextDeveloper\Commons\Database\Filters\DisposableEmailQueryFilter;

use NextDeveloper\Commons\Events\DisposableEmail\DisposableEmailCreatedEvent;
use NextDeveloper\Commons\Events\DisposableEmail\DisposableEmailCreatingEvent;

/**
* This class is responsible from managing the data for DisposableEmail
*
* Class DisposableEmailService.
*
* @package NextDeveloper\Commons\Database\Models
*/
class AbstractDisposableEmailService {
    public static function get(DisposableEmailQueryFilter $filter = null, array $params = []) : Collection|LengthAwarePaginator {
        $enablePaginate = array_key_exists('paginate', $params);

        /**
        * Here we are adding null request since if filter is null, this means that this function is called from
        * non http application. This is actually not I think its a correct way to handle this problem but it's a workaround.
        *
        * Please let me know if you have any other idea about this; baris.bulut@nextdeveloper.com
        */
        if($filter == null)
            $filter = new DisposableEmailQueryFilter(new Request());

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

        $model = DisposableEmail::filter($filter);

        if($model && $enablePaginate)
            return $model->paginate($perPage);
        else
            return $model->get();

        if(!$model && $enablePaginate)
            return DisposableEmail::paginate($perPage);
        else
            return DisposableEmail::get();
    }

    public static function getAll() {
        return DisposableEmail::all();
    }

    /**
    * This method returns the model by looking at reference id
    *
    * @param $ref
    * @return mixed
    */
    public static function getByRef($ref) : ?DisposableEmail {
        return DisposableEmail::findByRef($ref);
    }

    /**
    * This method returns the model by lookint at its id
    *
    * @param $id
    * @return DisposableEmail|null
    */
    public static function getById($id) : ?DisposableEmail {
        return DisposableEmail::where('id', $id)->first();
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

        try {
            $model = DisposableEmail::create($data);
        } catch(\Exception $e) {
            throw $e;
        }

        event( new DisposableEmailCreatedEvent($model) );

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
        $model = DisposableEmail::where('uuid', $id)->first();

        event( new DisposableEmailsUpdateingEvent($model) );

        try {
           $model = $model->update($data);
        } catch(\Exception $e) {
           throw $e;
        }

        event( new DisposableEmailsUpdatedEvent($model) );

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
        $model = DisposableEmail::where('uuid', $id)->first();

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