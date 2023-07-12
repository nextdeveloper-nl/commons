<?php

namespace NextDeveloper\Commons\Http\Controllers\DisposableEmail;

use Illuminate\Http\Request;
use NextDeveloper\Generator\Common\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\DisposableEmail\DisposableEmailUpdateRequest;
use NextDeveloper\Commons\Database\Filters\DisposableEmailQueryFilter;
use NextDeveloper\Commons\Services\DisposableEmailService;
use NextDeveloper\Commons\Http\Requests\DisposableEmail\DisposableEmailCreateRequest;

class DisposableEmailController extends AbstractController
{
    /**
    * This method returns the list of disposableemails.
    *
    * optional http params:
    * - paginate: If you set paginate parameter, the result will be returned paginated.
    *
    * @param DisposableEmailQueryFilter $filter An object that builds search query
    * @param Request $request Laravel request object, this holds all data about request. Automatically populated.
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(DisposableEmailQueryFilter $filter, Request $request) {
        $data = DisposableEmailService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
    * This method receives ID for the related model and returns the item to the client.
    *
    * @param $disposableEmailId
    * @return mixed|null
    * @throws \Laravel\Octane\Exceptions\DdException
    */
    public function show($ref) {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = DisposableEmailService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method created DisposableEmail object on database.
    *
    * @param DisposableEmailCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function store(DisposableEmailCreateRequest $request) {
        $model = DisposableEmailService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates DisposableEmail object on database.
    *
    * @param $disposableEmailId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function update($disposableEmailId, DisposableEmailUpdateRequest $request) {
        $model = DisposableEmailService::update($disposableEmailId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
    * This method updates DisposableEmail object on database.
    *
    * @param $disposableEmailId
    * @param CountryCreateRequest $request
    * @return mixed|null
    * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
    */
    public function destroy($disposableEmailId) {
        $model = DisposableEmailService::delete($disposableEmailId);

        return ResponsableFactory::makeResponse($this, $model);
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}