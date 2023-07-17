<?php

namespace NextDeveloper\Commons\Http\Controllers\CommonMedia;

use Illuminate\Http\Request;
use NextDeveloper\Generator\Common\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\CommonMedia\CommonMediaUpdateRequest;
use NextDeveloper\Commons\Database\Filters\CommonMediaQueryFilter;
use NextDeveloper\Commons\Services\CommonMediaService;
use NextDeveloper\Commons\Http\Requests\CommonMedia\CommonMediaCreateRequest;

class CommonMediaController extends AbstractController
{
    /**
    * This method returns the list of commonmedia.
    *
    * optional http params:
    * - paginate: If you set paginate parameter, the result will be returned paginated.
    *
    * @param CommonMediaQueryFilter $filter An object that builds search query
    * @param Request $request Laravel request object, this holds all data about request. Automatically populated.
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(CommonMediaQueryFilter $filter, Request $request) {
        $data = CommonMediaService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
    * This method receives ID for the related model and returns the item to the client.
    *
    * @param $commonMediaId
    * @return mixed|null
    * @throws \Laravel\Octane\Exceptions\DdException
    */
    public function show($ref) {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = CommonMediaService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method created CommonMedia object on database.
    *
    * @param CommonMediaCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(CommonMediaCreateRequest $request) {
        $model = CommonMediaService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonMedia object on database.
    *
    * @param $commonMediaId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function update($commonMediaId, CommonMediaUpdateRequest $request) {
        $model = CommonMediaService::update($commonMediaId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonMedia object on database.
    *
    * @param $commonMediaId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function destroy($commonMediaId) {
        $model = CommonMediaService::delete($commonMediaId);

        return ResponsableFactory::makeResponse($this, $model);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}