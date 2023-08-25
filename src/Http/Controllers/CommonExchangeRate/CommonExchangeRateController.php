<?php

namespace NextDeveloper\Commons\Http\Controllers\CommonExchangeRate;

use Illuminate\Http\Request;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\CommonExchangeRate\CommonExchangeRateUpdateRequest;
use NextDeveloper\Commons\Database\Filters\CommonExchangeRateQueryFilter;
use NextDeveloper\Commons\Services\CommonExchangeRateService;
use NextDeveloper\Commons\Http\Requests\CommonExchangeRate\CommonExchangeRateCreateRequest;

class CommonExchangeRateController extends AbstractController
{
    /**
    * This method returns the list of commonexchangerates.
    *
    * optional http params:
    * - paginate: If you set paginate parameter, the result will be returned paginated.
    *
    * @param CommonExchangeRateQueryFilter $filter An object that builds search query
    * @param Request $request Laravel request object, this holds all data about request. Automatically populated.
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(CommonExchangeRateQueryFilter $filter, Request $request) {
        $data = CommonExchangeRateService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
    * This method receives ID for the related model and returns the item to the client.
    *
    * @param $commonExchangeRateId
    * @return mixed|null
    * @throws \Laravel\Octane\Exceptions\DdException
    */
    public function show($ref) {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = CommonExchangeRateService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method created CommonExchangeRate object on database.
    *
    * @param CommonExchangeRateCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(CommonExchangeRateCreateRequest $request) {
        $model = CommonExchangeRateService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonExchangeRate object on database.
    *
    * @param $commonExchangeRateId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function update($commonExchangeRateId, CommonExchangeRateUpdateRequest $request) {
        $model = CommonExchangeRateService::update($commonExchangeRateId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonExchangeRate object on database.
    *
    * @param $commonExchangeRateId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function destroy($commonExchangeRateId) {
        $model = CommonExchangeRateService::delete($commonExchangeRateId);

        return ResponsableFactory::makeResponse($this, $model);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}