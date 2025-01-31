<?php

namespace NextDeveloper\Commons\Services;

use NextDeveloper\Commons\Database\Filters\CountriesQueryFilter;
use NextDeveloper\Commons\Database\GlobalScopes\LimitScope;
use NextDeveloper\Commons\Database\Models\Countries;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCountriesService;

/**
 * This class is responsible from managing the data for Countries
 *
 * Class CountriesService.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class CountriesService extends AbstractCountriesService
{

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

    public static function get(CountriesQueryFilter $filter = null, array $params = []): \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $countries = Countries::filter($filter)
            ->withoutGlobalScope(LimitScope::class)
            ->get();

        return $countries;
    }
}
