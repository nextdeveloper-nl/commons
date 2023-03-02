<?php

namespace NextDeveloper\Commons\Http\Controllers\Country;

use Illuminate\Http\Request;
use NextDeveloper\Generator\Common\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Database\Filters\CountryQueryFilter;
use NextDeveloper\Commons\Http\Transformers\CountryTransformer;
use NextDeveloper\Commons\Services\CountryService;

class CountryController extends AbstractController
{
    /**
    * This method returns the list of countries.
    *
    * optional http params:
    * - paginate: If you set paginate parameter, the result will be returned paginated.
    *
    * @param CountryQueryFilter $filter An object that builds search query
    * @param Request $request Laravel request object, this holds all data about request. Automatically populated.
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(CountryQueryFilter $filter, Request $request) {
        $isPaginationRequested = $request->has('paginate');
        $data = CountryService::get($filter, $isPaginationRequested);

        return ResponsableFactory::makeResponse($data);
    }
}