<?php

namespace NextDeveloper\Commons\Http\Controllers\CommonValidatable;

use Illuminate\Http\Request;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\CommonValidatable\CommonValidatableUpdateRequest;
use NextDeveloper\Commons\Database\Filters\CommonValidatableQueryFilter;
use NextDeveloper\Commons\Services\CommonValidatableService;
use NextDeveloper\Commons\Http\Requests\CommonValidatable\CommonValidatableCreateRequest;

class CommonValidatableController extends AbstractController
{
    /**
    * This method returns the list of commonvalidatables.
    *
    * optional http params:
    * - paginate: If you set paginate parameter, the result will be returned paginated.
    *
    * @param CommonValidatableQueryFilter $filter An object that builds search query
    * @param Request $request Laravel request object, this holds all data about request. Automatically populated.
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(CommonValidatableQueryFilter $filter, Request $request) {
        $data = CommonValidatableService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
    * This method receives ID for the related model and returns the item to the client.
    *
    * @param $commonValidatableId
    * @return mixed|null
    * @throws \Laravel\Octane\Exceptions\DdException
    */
    public function show($ref) {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = CommonValidatableService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method created CommonValidatable object on database.
    *
    * @param CommonValidatableCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(CommonValidatableCreateRequest $request) {
        $model = CommonValidatableService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonValidatable object on database.
    *
    * @param $commonValidatableId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function update($commonValidatableId, CommonValidatableUpdateRequest $request) {
        $model = CommonValidatableService::update($commonValidatableId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonValidatable object on database.
    *
    * @param $commonValidatableId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function destroy($commonValidatableId) {
        $model = CommonValidatableService::delete($commonValidatableId);

        return ResponsableFactory::makeResponse($this, $model);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}