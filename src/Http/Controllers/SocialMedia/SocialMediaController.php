<?php

namespace NextDeveloper\Commons\Http\Controllers\SocialMedia;

use Illuminate\Http\Request;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\SocialMedia\SocialMediaUpdateRequest;
use NextDeveloper\Commons\Database\Filters\SocialMediaQueryFilter;
use NextDeveloper\Commons\Services\SocialMediaService;
use NextDeveloper\Commons\Http\Requests\SocialMedia\SocialMediaCreateRequest;

class SocialMediaController extends AbstractController
{
    /**
    * This method returns the list of socialmedia.
    *
    * optional http params:
    * - paginate: If you set paginate parameter, the result will be returned paginated.
    *
    * @param SocialMediaQueryFilter $filter An object that builds search query
    * @param Request $request Laravel request object, this holds all data about request. Automatically populated.
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(SocialMediaQueryFilter $filter, Request $request) {
        $data = SocialMediaService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
    * This method receives ID for the related model and returns the item to the client.
    *
    * @param $socialMediaId
    * @return mixed|null
    * @throws \Laravel\Octane\Exceptions\DdException
    */
    public function show($ref) {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = SocialMediaService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method created SocialMedia object on database.
    *
    * @param SocialMediaCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(SocialMediaCreateRequest $request) {
        $model = SocialMediaService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates SocialMedia object on database.
    *
    * @param $socialMediaId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function update($socialMediaId, SocialMediaUpdateRequest $request) {
        $model = SocialMediaService::update($socialMediaId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates SocialMedia object on database.
    *
    * @param $socialMediaId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function destroy($socialMediaId) {
        $model = SocialMediaService::delete($socialMediaId);

        return ResponsableFactory::makeResponse($this, $model);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}