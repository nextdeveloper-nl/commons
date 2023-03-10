<?php

namespace NextDeveloper\Commons\Http\Controllers\Country;

use Illuminate\Http\Request;
use NextDeveloper\Generator\Common\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Database\Filters\CountryQueryFilter;
use NextDeveloper\Commons\Http\Transformers\CountryTransformer;
use NextDeveloper\Commons\Services\CountryService;
use NextDeveloper\Commons\Http\Requests\Country\CountryCreateRequest;

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
        $data = CountryService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
    * This method receives ID for the related model and returns the item to the client.
    *
    * @param $countryId
    * @return mixed|null
    * @throws \Laravel\Octane\Exceptions\DdException
    */
    public function show($ref) {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file in NextDeveloper Platform Project
        $model = CountryService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method created Country object on database.
    *
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(CountryCreateRequest $request) {
        $model = CountryService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }
}