<?php

namespace NextDeveloper\Commons\Http\Controllers\CommonDomain;

use Illuminate\Http\Request;
use NextDeveloper\Generator\Common\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\CommonDomain\CommonDomainUpdateRequest;
use NextDeveloper\Commons\Database\Filters\CommonDomainQueryFilter;
use NextDeveloper\Commons\Services\CommonDomainService;
use NextDeveloper\Commons\Http\Requests\CommonDomain\CommonDomainCreateRequest;

class CommonDomainController extends AbstractController
{
    /**
    * This method returns the list of commondomains.
    *
    * optional http params:
    * - paginate: If you set paginate parameter, the result will be returned paginated.
    *
    * @param CommonDomainQueryFilter $filter An object that builds search query
    * @param Request $request Laravel request object, this holds all data about request. Automatically populated.
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(CommonDomainQueryFilter $filter, Request $request) {
        $data = CommonDomainService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
    * This method receives ID for the related model and returns the item to the client.
    *
    * @param $commonDomainId
    * @return mixed|null
    * @throws \Laravel\Octane\Exceptions\DdException
    */
    public function show($ref) {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = CommonDomainService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method created CommonDomain object on database.
    *
    * @param CommonDomainCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(CommonDomainCreateRequest $request) {
        $model = CommonDomainService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonDomain object on database.
    *
    * @param $commonDomainId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function update($commonDomainId, CommonDomainUpdateRequest $request) {
        $model = CommonDomainService::update($commonDomainId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonDomain object on database.
    *
    * @param $commonDomainId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function destroy($commonDomainId) {
        $model = CommonDomainService::delete($commonDomainId);

        return ResponsableFactory::makeResponse($this, $model);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}