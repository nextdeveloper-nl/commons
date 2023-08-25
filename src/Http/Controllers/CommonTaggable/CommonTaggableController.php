<?php

namespace NextDeveloper\Commons\Http\Controllers\CommonTaggable;

use Illuminate\Http\Request;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\CommonTaggable\CommonTaggableUpdateRequest;
use NextDeveloper\Commons\Database\Filters\CommonTaggableQueryFilter;
use NextDeveloper\Commons\Services\CommonTaggableService;
use NextDeveloper\Commons\Http\Requests\CommonTaggable\CommonTaggableCreateRequest;

class CommonTaggableController extends AbstractController
{
    /**
    * This method returns the list of commontaggables.
    *
    * optional http params:
    * - paginate: If you set paginate parameter, the result will be returned paginated.
    *
    * @param CommonTaggableQueryFilter $filter An object that builds search query
    * @param Request $request Laravel request object, this holds all data about request. Automatically populated.
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(CommonTaggableQueryFilter $filter, Request $request) {
        $data = CommonTaggableService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
    * This method receives ID for the related model and returns the item to the client.
    *
    * @param $commonTaggableId
    * @return mixed|null
    * @throws \Laravel\Octane\Exceptions\DdException
    */
    public function show($ref) {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = CommonTaggableService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method created CommonTaggable object on database.
    *
    * @param CommonTaggableCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(CommonTaggableCreateRequest $request) {
        $model = CommonTaggableService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonTaggable object on database.
    *
    * @param $commonTaggableId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function update($commonTaggableId, CommonTaggableUpdateRequest $request) {
        $model = CommonTaggableService::update($commonTaggableId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonTaggable object on database.
    *
    * @param $commonTaggableId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function destroy($commonTaggableId) {
        $model = CommonTaggableService::delete($commonTaggableId);

        return ResponsableFactory::makeResponse($this, $model);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}