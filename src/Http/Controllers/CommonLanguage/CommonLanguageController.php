<?php

namespace NextDeveloper\Commons\Http\Controllers\CommonLanguage;

use Illuminate\Http\Request;
use NextDeveloper\Generator\Common\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\CommonLanguage\CommonLanguageUpdateRequest;
use NextDeveloper\Commons\Database\Filters\CommonLanguageQueryFilter;
use NextDeveloper\Commons\Services\CommonLanguageService;
use NextDeveloper\Commons\Http\Requests\CommonLanguage\CommonLanguageCreateRequest;

class CommonLanguageController extends AbstractController
{
    /**
    * This method returns the list of commonlanguages.
    *
    * optional http params:
    * - paginate: If you set paginate parameter, the result will be returned paginated.
    *
    * @param CommonLanguageQueryFilter $filter An object that builds search query
    * @param Request $request Laravel request object, this holds all data about request. Automatically populated.
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(CommonLanguageQueryFilter $filter, Request $request) {
        $data = CommonLanguageService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
    * This method receives ID for the related model and returns the item to the client.
    *
    * @param $commonLanguageId
    * @return mixed|null
    * @throws \Laravel\Octane\Exceptions\DdException
    */
    public function show($ref) {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = CommonLanguageService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method created CommonLanguage object on database.
    *
    * @param CommonLanguageCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(CommonLanguageCreateRequest $request) {
        $model = CommonLanguageService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonLanguage object on database.
    *
    * @param $commonLanguageId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function update($commonLanguageId, CommonLanguageUpdateRequest $request) {
        $model = CommonLanguageService::update($commonLanguageId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates CommonLanguage object on database.
    *
    * @param $commonLanguageId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function destroy($commonLanguageId) {
        $model = CommonLanguageService::delete($commonLanguageId);

        return ResponsableFactory::makeResponse($this, $model);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}