<?php

namespace NextDeveloper\Commons\Http\Controllers\Domainables;

use Illuminate\Http\Request;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\Domainables\DomainablesUpdateRequest;
use NextDeveloper\Commons\Database\Filters\DomainablesQueryFilter;
use NextDeveloper\Commons\Services\DomainablesService;
use NextDeveloper\Commons\Http\Requests\Domainables\DomainablesCreateRequest;

class DomainablesController extends AbstractController
{
    /**
    * This method returns the list of domainables.
    *
    * optional http params:
    * - paginate: If you set paginate parameter, the result will be returned paginated.
    *
    * @param DomainablesQueryFilter $filter An object that builds search query
    * @param Request $request Laravel request object, this holds all data about request. Automatically populated.
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(DomainablesQueryFilter $filter, Request $request) {
        $data = DomainablesService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
    * This method receives ID for the related model and returns the item to the client.
    *
    * @param $domainablesId
    * @return mixed|null
    * @throws \Laravel\Octane\Exceptions\DdException
    */
    public function show($ref) {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = DomainablesService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method created Domainables object on database.
    *
    * @param DomainablesCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(DomainablesCreateRequest $request) {
        $model = DomainablesService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates Domainables object on database.
    *
    * @param $domainablesId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function update($domainablesId, DomainablesUpdateRequest $request) {
        $model = DomainablesService::update($domainablesId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates Domainables object on database.
    *
    * @param $domainablesId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function destroy($domainablesId) {
        $model = DomainablesService::delete($domainablesId);

        return ResponsableFactory::makeResponse($this, $model);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}