<?php

namespace NextDeveloper\Commons\Http\Controllers\CommonRegistry;

use Illuminate\Http\Request;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\CommonRegistry\CommonRegistryUpdateRequest;
use NextDeveloper\Commons\Database\Filters\CommonRegistryQueryFilter;
use NextDeveloper\Commons\Services\CommonRegistryService;
use NextDeveloper\Commons\Http\Requests\CommonRegistry\CommonRegistryCreateRequest;

class CommonRegistryController extends AbstractController
{
    /**
    * This method returns the list of commonregistries.
    *
    * optional http params:
    * - paginate: If you set paginate parameter, the result will be returned paginated.
    *
    * @param CommonRegistryQueryFilter $filter An object that builds search query
    * @param Request $request Laravel request object, this holds all data about request. Automatically populated.
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(CommonRegistryQueryFilter $filter, Request $request) {
        $data = CommonRegistryService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
    * This method receives ID for the related model and returns the item to the client.
    *
    * @param $commonRegistryId
    * @return mixed|null
    * @throws \Laravel\Octane\Exceptions\DdException
    */
    public function show($ref) {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = CommonRegistryService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method created CommonRegistry object on database.
    *
    * @param CommonRegistryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(CommonRegistryCreateRequest $request) {
        $model = CommonRegistryService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonRegistry object on database.
    *
    * @param $commonRegistryId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function update($commonRegistryId, CommonRegistryUpdateRequest $request) {
        $model = CommonRegistryService::update($commonRegistryId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonRegistry object on database.
    *
    * @param $commonRegistryId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function destroy($commonRegistryId) {
        $model = CommonRegistryService::delete($commonRegistryId);

        return ResponsableFactory::makeResponse($this, $model);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}