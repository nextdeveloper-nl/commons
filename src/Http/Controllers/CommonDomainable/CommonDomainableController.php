<?php

namespace NextDeveloper\Commons\Http\Controllers\CommonDomainable;

use Illuminate\Http\Request;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\CommonDomainable\CommonDomainableUpdateRequest;
use NextDeveloper\Commons\Database\Filters\CommonDomainableQueryFilter;
use NextDeveloper\Commons\Services\CommonDomainableService;
use NextDeveloper\Commons\Http\Requests\CommonDomainable\CommonDomainableCreateRequest;

class CommonDomainableController extends AbstractController
{
    /**
    * This method returns the list of commondomainables.
    *
    * optional http params:
    * - paginate: If you set paginate parameter, the result will be returned paginated.
    *
    * @param CommonDomainableQueryFilter $filter An object that builds search query
    * @param Request $request Laravel request object, this holds all data about request. Automatically populated.
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(CommonDomainableQueryFilter $filter, Request $request) {
        $data = CommonDomainableService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
    * This method receives ID for the related model and returns the item to the client.
    *
    * @param $commonDomainableId
    * @return mixed|null
    * @throws \Laravel\Octane\Exceptions\DdException
    */
    public function show($ref) {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = CommonDomainableService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method created CommonDomainable object on database.
    *
    * @param CommonDomainableCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(CommonDomainableCreateRequest $request) {
        $model = CommonDomainableService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonDomainable object on database.
    *
    * @param $commonDomainableId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function update($commonDomainableId, CommonDomainableUpdateRequest $request) {
        $model = CommonDomainableService::update($commonDomainableId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonDomainable object on database.
    *
    * @param $commonDomainableId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function destroy($commonDomainableId) {
        $model = CommonDomainableService::delete($commonDomainableId);

        return ResponsableFactory::makeResponse($this, $model);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}