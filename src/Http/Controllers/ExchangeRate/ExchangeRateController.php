<?php

namespace NextDeveloper\Commons\Http\Controllers\ExchangeRate;

use Illuminate\Http\Request;
use NextDeveloper\Generator\Common\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\ExchangeRate\ExchangeRateUpdateRequest;
use NextDeveloper\Commons\Database\Filters\ExchangeRateQueryFilter;
use NextDeveloper\Commons\Services\ExchangeRateService;
use NextDeveloper\Commons\Http\Requests\ExchangeRate\ExchangeRateCreateRequest;

class ExchangeRateController extends AbstractController
{
    /**
    * This method returns the list of exchangerates.
    *
    * optional http params:
    * - paginate: If you set paginate parameter, the result will be returned paginated.
    *
    * @param ExchangeRateQueryFilter $filter An object that builds search query
    * @param Request $request Laravel request object, this holds all data about request. Automatically populated.
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(ExchangeRateQueryFilter $filter, Request $request) {
        $data = ExchangeRateService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
    * This method receives ID for the related model and returns the item to the client.
    *
    * @param $exchangeRateId
    * @return mixed|null
    * @throws \Laravel\Octane\Exceptions\DdException
    */
    public function show($ref) {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = ExchangeRateService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method created ExchangeRate object on database.
    *
    * @param ExchangeRateCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(ExchangeRateCreateRequest $request) {
        $model = ExchangeRateService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates ExchangeRate object on database.
    *
    * @param $exchangeRateId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function update($exchangeRateId, ExchangeRateUpdateRequest $request) {
        $model = ExchangeRateService::update($exchangeRateId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates ExchangeRate object on database.
    *
    * @param $exchangeRateId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function destroy($exchangeRateId) {
        $model = ExchangeRateService::delete($exchangeRateId);

        return ResponsableFactory::makeResponse($this, $model);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}