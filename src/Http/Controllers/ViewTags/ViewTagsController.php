<?php

namespace NextDeveloper\Commons\Http\Controllers\ViewTags;

use Illuminate\Http\Request;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Commons\Http\Response\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\ViewTags\ViewTagsUpdateRequest;
use NextDeveloper\Commons\Database\Filters\ViewTagsQueryFilter;
use NextDeveloper\Commons\Services\ViewTagsService;
use NextDeveloper\Commons\Http\Requests\ViewTags\ViewTagsCreateRequest;

class ViewTagsController extends AbstractController
{
    /**
     * This method returns the list of viewtags.
     *
     * optional http params:
     * - paginate: If you set paginate parameter, the result will be returned paginated.
     *
     * @param  ViewTagsQueryFilter $filter  An object that builds search query
     * @param  Request             $request Laravel request object, this holds all data about request. Automatically populated.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ViewTagsQueryFilter $filter, Request $request)
    {
        $data = ViewTagsService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
     * This method receives ID for the related model and returns the item to the client.
     *
     * @param  $viewTagsId
     * @return mixed|null
     * @throws \Laravel\Octane\Exceptions\DdException
     */
    public function show($ref)
    {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = ViewTagsService::getByRef($ref);

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
        $objects = ViewTagsService::getSubObjects($ref, $subObject);

        return ResponsableFactory::makeResponse($this, $objects);
    }

    /**
     * This method created ViewTags object on database.
     *
     * @param  ViewTagsCreateRequest $request
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function store(ViewTagsCreateRequest $request)
    {
        $model = ViewTagsService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
     * This method updates ViewTags object on database.
     *
     * @param  $viewTagsId
     * @param  CountryCreateRequest $request
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function update($viewTagsId, ViewTagsUpdateRequest $request)
    {
        $model = ViewTagsService::update($viewTagsId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
     * This method updates ViewTags object on database.
     *
     * @param  $viewTagsId
     * @param  CountryCreateRequest $request
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function destroy($viewTagsId)
    {
        $model = ViewTagsService::delete($viewTagsId);

        return $this->noContent();
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
