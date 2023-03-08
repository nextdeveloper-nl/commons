<?php

namespace NextDeveloper\Commons\Services\AbstractServices;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use NextDeveloper\Commons\Database\Models\Country;
use NextDeveloper\Commons\Database\Filters\CountryQueryFilter;

use NextDeveloper\Commons\Events\Countries\CountriesCreatedEvent;
use NextDeveloper\Commons\Events\Countries\CountriesCreatingEvent;

/**
* This class is responsible from managing the data for Country
*
* Class CountryService.
*
* @package NextDeveloper\Commons\Database\Models
*/
class AbstractCountryService {
    public static function get(CountryQueryFilter $filter = null, array $params = []) : Collection|LengthAwarePaginator {
        $enablePaginate = array_key_exists('paginate', $params);

        /**
        * Here we are adding null request since if filter is null, this means that this function is called from
        * non http application. This is actually not I think its a correct way to handle this problem but it's a workaround.
        *
        * Please let me know if you have any other idea about this; baris.bulut@nextdeveloper.com
        */
        if($filter == null)
            $filter = new CountryQueryFilter(new Request());

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

        $model = Country::filter($filter);

        if($model && $enablePaginate)
            return $model->paginate($perPage);
        else
            return $model->get();

        if(!$model && $enablePaginate)
            return Country::paginate($perPage);
        else
            return Country::get();
    }

    public static function getAll() {
        return Country::all();
    }

    public static function create(array $data) {
        event( new CountriesCreatingEvent() );

        $model = Country::create([

        ]);

        event( new CountriesCreatedEvent($model) );
    }
}