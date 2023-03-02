<?php

namespace NextDeveloper\Commons\Services\AbstractServices;

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
    public static function get(CountryQueryFilter $filter = null, bool $enablePaginate = true, $page = 0) : ?Collection {
        if($filter)
            return Country::filter($filter)->get();
        else
            return Country::get();
    }

    public static function getPaginated(CountryQueryFilter $filter = null, bool $enablePaginate = true, $page = 0) : ?LengthAwarePaginator {
        if($filter)
            return Country::filter($filter)->paginate();
        else
            return Country::paginate();
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