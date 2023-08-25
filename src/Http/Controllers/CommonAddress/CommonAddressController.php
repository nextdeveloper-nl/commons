<?php

namespace NextDeveloper\Commons\Http\Controllers\CommonAddress;

use Illuminate\Http\Request;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\CommonAddress\CommonAddressUpdateRequest;
use NextDeveloper\Commons\Database\Filters\CommonAddressQueryFilter;
use NextDeveloper\Commons\Services\CommonAddressService;
use NextDeveloper\Commons\Http\Requests\CommonAddress\CommonAddressCreateRequest;

class CommonAddressController extends AbstractController
{
    /**
    * This method returns the list of commonaddresses.
    *
    * optional http params:
    * - paginate: If you set paginate parameter, the result will be returned paginated.
    *
    * @param CommonAddressQueryFilter $filter An object that builds search query
    * @param Request $request Laravel request object, this holds all data about request. Automatically populated.
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(CommonAddressQueryFilter $filter, Request $request) {
        $data = CommonAddressService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
    * This method receives ID for the related model and returns the item to the client.
    *
    * @param $commonAddressId
    * @return mixed|null
    * @throws \Laravel\Octane\Exceptions\DdException
    */
    public function show($ref) {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = CommonAddressService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method created CommonAddress object on database.
    *
    * @param CommonAddressCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(CommonAddressCreateRequest $request) {
        $model = CommonAddressService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonAddress object on database.
    *
    * @param $commonAddressId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function update($commonAddressId, CommonAddressUpdateRequest $request) {
        $model = CommonAddressService::update($commonAddressId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonAddress object on database.
    *
    * @param $commonAddressId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function destroy($commonAddressId) {
        $model = CommonAddressService::delete($commonAddressId);

        return ResponsableFactory::makeResponse($this, $model);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}