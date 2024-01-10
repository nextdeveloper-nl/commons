<?php

namespace NextDeveloper\Commons\Http\Controllers\ExchangeRates;

use Illuminate\Http\Request;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Commons\Http\Response\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\ExchangeRates\ExchangeRatesUpdateRequest;
use NextDeveloper\Commons\Database\Filters\ExchangeRatesQueryFilter;
use NextDeveloper\Commons\Services\ExchangeRatesService;
use NextDeveloper\Commons\Http\Requests\ExchangeRates\ExchangeRatesCreateRequest;

class ExchangeRatesController extends AbstractController
{
    /**
     * This method returns the list of exchangerates.
     *
     * optional http params:
     * - paginate: If you set paginate parameter, the result will be returned paginated.
     *
     * @param  ExchangeRatesQueryFilter $filter  An object that builds search query
     * @param  Request                  $request Laravel request object, this holds all data about request. Automatically populated.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ExchangeRatesQueryFilter $filter, Request $request)
    {
        $data = ExchangeRatesService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
     * This method receives ID for the related model and returns the item to the client.
     *
     * @param  $exchangeRatesId
     * @return mixed|null
     * @throws \Laravel\Octane\Exceptions\DdException
     */
    public function show($ref)
    {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = ExchangeRatesService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
     * This method returns the list of sub objects the related object.
     *
     * @param  $ref
     * @param  $subObject
     * @return void
     */
    public function subObjects($ref, $subObject)
    {
        $objects = ExchangeRatesService::getSubObjects($ref, $subObject);

        return ResponsableFactory::makeResponse($this, $objects);
    }

    /**
     * This method created ExchangeRates object on database.
     *
     * @param  ExchangeRatesCreateRequest $request
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function store(ExchangeRatesCreateRequest $request)
    {
        $model = ExchangeRatesService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
     * This method updates ExchangeRates object on database.
     *
     * @param  $exchangeRatesId
     * @param  CountryCreateRequest $request
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function update($exchangeRatesId, ExchangeRatesUpdateRequest $request)
    {
        $model = ExchangeRatesService::update($exchangeRatesId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
     * This method updates ExchangeRates object on database.
     *
     * @param  $exchangeRatesId
     * @param  CountryCreateRequest $request
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function destroy($exchangeRatesId)
    {
        $model = ExchangeRatesService::delete($exchangeRatesId);

        return $this->noContent();
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
