<?php

namespace NextDeveloper\Commons\Http\Controllers\CommonCountry;

use Illuminate\Http\Request;
use NextDeveloper\Generator\Common\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\CommonCountry\CommonCountryUpdateRequest;
use NextDeveloper\Commons\Database\Filters\CommonCountryQueryFilter;
use NextDeveloper\Commons\Services\CommonCountryService;
use NextDeveloper\Commons\Http\Requests\CommonCountry\CommonCountryCreateRequest;

class CommonCountryController extends AbstractController
{
    /**
    * This method returns the list of commoncountries.
    *
    * optional http params:
    * - paginate: If you set paginate parameter, the result will be returned paginated.
    *
    * @param CommonCountryQueryFilter $filter An object that builds search query
    * @param Request $request Laravel request object, this holds all data about request. Automatically populated.
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(CommonCountryQueryFilter $filter, Request $request) {
        $data = CommonCountryService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
    * This method receives ID for the related model and returns the item to the client.
    *
    * @param $commonCountryId
    * @return mixed|null
    * @throws \Laravel\Octane\Exceptions\DdException
    */
    public function show($ref) {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = CommonCountryService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method created CommonCountry object on database.
    *
    * @param CommonCountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(CommonCountryCreateRequest $request) {
        $model = CommonCountryService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonCountry object on database.
    *
    * @param $commonCountryId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function update($commonCountryId, CommonCountryUpdateRequest $request) {
        $model = CommonCountryService::update($commonCountryId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonCountry object on database.
    *
    * @param $commonCountryId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function destroy($commonCountryId) {
        $model = CommonCountryService::delete($commonCountryId);

        return ResponsableFactory::makeResponse($this, $model);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}