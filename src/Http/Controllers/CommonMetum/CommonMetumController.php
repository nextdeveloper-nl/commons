<?php

namespace NextDeveloper\Commons\Http\Controllers\CommonMetum;

use Illuminate\Http\Request;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\CommonMetum\CommonMetumUpdateRequest;
use NextDeveloper\Commons\Database\Filters\CommonMetumQueryFilter;
use NextDeveloper\Commons\Services\CommonMetumService;
use NextDeveloper\Commons\Http\Requests\CommonMetum\CommonMetumCreateRequest;

class CommonMetumController extends AbstractController
{
    /**
    * This method returns the list of commonmeta.
    *
    * optional http params:
    * - paginate: If you set paginate parameter, the result will be returned paginated.
    *
    * @param CommonMetumQueryFilter $filter An object that builds search query
    * @param Request $request Laravel request object, this holds all data about request. Automatically populated.
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(CommonMetumQueryFilter $filter, Request $request) {
        $data = CommonMetumService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
    * This method receives ID for the related model and returns the item to the client.
    *
    * @param $commonMetumId
    * @return mixed|null
    * @throws \Laravel\Octane\Exceptions\DdException
    */
    public function show($ref) {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = CommonMetumService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method created CommonMetum object on database.
    *
    * @param CommonMetumCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(CommonMetumCreateRequest $request) {
        $model = CommonMetumService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonMetum object on database.
    *
    * @param $commonMetumId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function update($commonMetumId, CommonMetumUpdateRequest $request) {
        $model = CommonMetumService::update($commonMetumId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonMetum object on database.
    *
    * @param $commonMetumId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function destroy($commonMetumId) {
        $model = CommonMetumService::delete($commonMetumId);

        return ResponsableFactory::makeResponse($this, $model);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}