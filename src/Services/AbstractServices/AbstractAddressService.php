<?php

namespace NextDeveloper\Commons\Services\AbstractServices;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use NextDeveloper\Commons\Database\Models\Address;
use NextDeveloper\Commons\Database\Filters\AddressQueryFilter;

use NextDeveloper\Commons\Events\Address\AddressCreatedEvent;
use NextDeveloper\Commons\Events\Address\AddressCreatingEvent;

/**
* This class is responsible from managing the data for Address
*
* Class AddressService.
*
* @package NextDeveloper\Commons\Database\Models
*/
class AbstractAddressService {
    public static function get(AddressQueryFilter $filter = null, array $params = []) : Collection|LengthAwarePaginator {
        $enablePaginate = array_key_exists('paginate', $params);

        /**
        * Here we are adding null request since if filter is null, this means that this function is called from
        * non http application. This is actually not I think its a correct way to handle this problem but it's a workaround.
        *
        * Please let me know if you have any other idea about this; baris.bulut@nextdeveloper.com
        */
        if($filter == null)
            $filter = new AddressQueryFilter(new Request());

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

        $model = Address::filter($filter);

        if($model && $enablePaginate)
            return $model->paginate($perPage);
        else
            return $model->get();

        if(!$model && $enablePaginate)
            return Address::paginate($perPage);
        else
            return Address::get();
    }

    public static function getAll() {
        return Address::all();
    }

    /**
    * This method returns the model by looking at reference id
    *
    * @param $ref
    * @return mixed
    */
    public static function getByRef($ref) : ?Address {
        return Address::findByRef($ref);
    }

    /**
    * This method returns the model by lookint at its id
    *
    * @param $id
    * @return Address|null
    */
    public static function getById($id) : ?Address {
        return Address::where('id', $id)->first();
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
        event( new AddressCreatingEvent() );

        try {
            $model = Address::create($data);
        } catch(\Exception $e) {
            throw $e;
        }

        event( new AddressCreatedEvent($model) );

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
        $model = Address::where('uuid', $id)->first();

        event( new AddressesUpdateingEvent($model) );

        try {
           $model = $model->update($data);
        } catch(\Exception $e) {
           throw $e;
        }

        event( new AddressesUpdatedEvent($model) );

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
        $model = Address::where('uuid', $id)->first();

        event( new AddressesDeletingEvent() );

        try {
            $model = $model->delete();
        } catch(\Exception $e) {
            throw $e;
        }

        event( new AddressesDeletedEvent($model) );

        return $model;
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}