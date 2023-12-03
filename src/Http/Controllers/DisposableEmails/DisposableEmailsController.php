<?php

namespace NextDeveloper\Commons\Http\Controllers\DisposableEmails;

use Illuminate\Http\Request;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\DisposableEmails\DisposableEmailsUpdateRequest;
use NextDeveloper\Commons\Database\Filters\DisposableEmailsQueryFilter;
use NextDeveloper\Commons\Services\DisposableEmailsService;
use NextDeveloper\Commons\Http\Requests\DisposableEmails\DisposableEmailsCreateRequest;

class DisposableEmailsController extends AbstractController
{
    /**
     * This method returns the list of disposableemails.
     *
     * optional http params:
     * - paginate: If you set paginate parameter, the result will be returned paginated.
     *
     * @param  DisposableEmailsQueryFilter $filter  An object that builds search query
     * @param  Request                     $request Laravel request object, this holds all data about request. Automatically populated.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(DisposableEmailsQueryFilter $filter, Request $request)
    {
        $data = DisposableEmailsService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
     * This method receives ID for the related model and returns the item to the client.
     *
     * @param  $disposableEmailsId
     * @return mixed|null
     * @throws \Laravel\Octane\Exceptions\DdException
     */
    public function show($ref)
    {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = DisposableEmailsService::getByRef($ref);

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
        $objects = DisposableEmailsService::getSubObjects($ref, $subObject);

        return ResponsableFactory::makeResponse($this, $objects);
    }

    /**
     * This method created DisposableEmails object on database.
     *
     * @param  DisposableEmailsCreateRequest $request
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function store(DisposableEmailsCreateRequest $request)
    {
        $model = DisposableEmailsService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
     * This method updates DisposableEmails object on database.
     *
     * @param  $disposableEmailsId
     * @param  CountryCreateRequest $request
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function update($disposableEmailsId, DisposableEmailsUpdateRequest $request)
    {
        $model = DisposableEmailsService::update($disposableEmailsId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
     * This method updates DisposableEmails object on database.
     *
     * @param  $disposableEmailsId
     * @param  CountryCreateRequest $request
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function destroy($disposableEmailsId)
    {
        $model = DisposableEmailsService::delete($disposableEmailsId);

        return $this->noContent();
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
