<?php

namespace NextDeveloper\Commons\Http\Controllers\Categories;

use Illuminate\Http\Request;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Commons\Http\Response\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\Categories\CategoriesUpdateRequest;
use NextDeveloper\Commons\Database\Filters\CategoriesQueryFilter;
use NextDeveloper\Commons\Services\CategoriesService;
use NextDeveloper\Commons\Http\Requests\Categories\CategoriesCreateRequest;

class CategoriesController extends AbstractController
{
    /**
     * This method returns the list of categories.
     *
     * optional http params:
     * - paginate: If you set paginate parameter, the result will be returned paginated.
     *
     * @param  CategoriesQueryFilter $filter  An object that builds search query
     * @param  Request               $request Laravel request object, this holds all data about request. Automatically populated.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(CategoriesQueryFilter $filter, Request $request)
    {
        $data = CategoriesService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
     * This method receives ID for the related model and returns the item to the client.
     *
     * @param  $categoriesId
     * @return mixed|null
     * @throws \Laravel\Octane\Exceptions\DdException
     */
    public function show($ref)
    {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = CategoriesService::getByRef($ref);

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
        $objects = CategoriesService::getSubObjects($ref, $subObject);

        return ResponsableFactory::makeResponse($this, $objects);
    }

    /**
     * This method created Categories object on database.
     *
     * @param  CategoriesCreateRequest $request
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function store(CategoriesCreateRequest $request)
    {
        $model = CategoriesService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
     * This method updates Categories object on database.
     *
     * @param  $categoriesId
     * @param  CountryCreateRequest $request
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function update($categoriesId, CategoriesUpdateRequest $request)
    {
        $model = CategoriesService::update($categoriesId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
     * This method updates Categories object on database.
     *
     * @param  $categoriesId
     * @param  CountryCreateRequest $request
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function destroy($categoriesId)
    {
        $model = CategoriesService::delete($categoriesId);

        return $this->noContent();
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
