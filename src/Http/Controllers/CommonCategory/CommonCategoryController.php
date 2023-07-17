<?php

namespace NextDeveloper\Commons\Http\Controllers\CommonCategory;

use Illuminate\Http\Request;
use NextDeveloper\Generator\Common\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\CommonCategory\CommonCategoryUpdateRequest;
use NextDeveloper\Commons\Database\Filters\CommonCategoryQueryFilter;
use NextDeveloper\Commons\Services\CommonCategoryService;
use NextDeveloper\Commons\Http\Requests\CommonCategory\CommonCategoryCreateRequest;

class CommonCategoryController extends AbstractController
{
    /**
    * This method returns the list of commoncategories.
    *
    * optional http params:
    * - paginate: If you set paginate parameter, the result will be returned paginated.
    *
    * @param CommonCategoryQueryFilter $filter An object that builds search query
    * @param Request $request Laravel request object, this holds all data about request. Automatically populated.
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(CommonCategoryQueryFilter $filter, Request $request) {
        $data = CommonCategoryService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
    * This method receives ID for the related model and returns the item to the client.
    *
    * @param $commonCategoryId
    * @return mixed|null
    * @throws \Laravel\Octane\Exceptions\DdException
    */
    public function show($ref) {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = CommonCategoryService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method created CommonCategory object on database.
    *
    * @param CommonCategoryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(CommonCategoryCreateRequest $request) {
        $model = CommonCategoryService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonCategory object on database.
    *
    * @param $commonCategoryId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function update($commonCategoryId, CommonCategoryUpdateRequest $request) {
        $model = CommonCategoryService::update($commonCategoryId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonCategory object on database.
    *
    * @param $commonCategoryId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function destroy($commonCategoryId) {
        $model = CommonCategoryService::delete($commonCategoryId);

        return ResponsableFactory::makeResponse($this, $model);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}