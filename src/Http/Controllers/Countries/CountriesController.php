<?php

namespace NextDeveloper\Commons\Http\Controllers\Countries;

use Illuminate\Http\Request;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\Countries\CountriesUpdateRequest;
use NextDeveloper\Commons\Database\Filters\CountriesQueryFilter;
use NextDeveloper\Commons\Services\CountriesService;
use NextDeveloper\Commons\Http\Requests\Countries\CountriesCreateRequest;

class CountriesController extends AbstractController
{
    /**
    * This method returns the list of countries.
    *
    * optional http params:
    * - paginate: If you set paginate parameter, the result will be returned paginated.
    *
    * @param CountriesQueryFilter $filter An object that builds search query
    * @param Request $request Laravel request object, this holds all data about request. Automatically populated.
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(CountriesQueryFilter $filter, Request $request) {
        $data = CountriesService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
    * This method receives ID for the related model and returns the item to the client.
    *
    * @param $countriesId
    * @return mixed|null
    * @throws \Laravel\Octane\Exceptions\DdException
    */
    public function show($ref) {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = CountriesService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method created Countries object on database.
    *
    * @param CountriesCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(CountriesCreateRequest $request) {
        $model = CountriesService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates Countries object on database.
    *
    * @param $countriesId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function update($countriesId, CountriesUpdateRequest $request) {
        $model = CountriesService::update($countriesId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates Countries object on database.
    *
    * @param $countriesId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function destroy($countriesId) {
        $model = CountriesService::delete($countriesId);

        return ResponsableFactory::makeResponse($this, $model);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}