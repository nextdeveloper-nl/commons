<?php

namespace NextDeveloper\Commons\Http\Controllers\CommonSocialMedia;

use Illuminate\Http\Request;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\CommonSocialMedia\CommonSocialMediaUpdateRequest;
use NextDeveloper\Commons\Database\Filters\CommonSocialMediaQueryFilter;
use NextDeveloper\Commons\Services\CommonSocialMediaService;
use NextDeveloper\Commons\Http\Requests\CommonSocialMedia\CommonSocialMediaCreateRequest;

class CommonSocialMediaController extends AbstractController
{
    /**
    * This method returns the list of commonsocialmedia.
    *
    * optional http params:
    * - paginate: If you set paginate parameter, the result will be returned paginated.
    *
    * @param CommonSocialMediaQueryFilter $filter An object that builds search query
    * @param Request $request Laravel request object, this holds all data about request. Automatically populated.
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(CommonSocialMediaQueryFilter $filter, Request $request) {
        $data = CommonSocialMediaService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
    * This method receives ID for the related model and returns the item to the client.
    *
    * @param $commonSocialMediaId
    * @return mixed|null
    * @throws \Laravel\Octane\Exceptions\DdException
    */
    public function show($ref) {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = CommonSocialMediaService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method created CommonSocialMedia object on database.
    *
    * @param CommonSocialMediaCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(CommonSocialMediaCreateRequest $request) {
        $model = CommonSocialMediaService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonSocialMedia object on database.
    *
    * @param $commonSocialMediaId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function update($commonSocialMediaId, CommonSocialMediaUpdateRequest $request) {
        $model = CommonSocialMediaService::update($commonSocialMediaId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonSocialMedia object on database.
    *
    * @param $commonSocialMediaId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function destroy($commonSocialMediaId) {
        $model = CommonSocialMediaService::delete($commonSocialMediaId);

        return ResponsableFactory::makeResponse($this, $model);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}