<?php

namespace NextDeveloper\Commons\Http\Controllers\Meta;

use Illuminate\Http\Request;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Commons\Http\Response\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\Meta\MetaUpdateRequest;
use NextDeveloper\Commons\Database\Filters\MetaQueryFilter;
use NextDeveloper\Commons\Services\MetaService;
use NextDeveloper\Commons\Http\Requests\Meta\MetaCreateRequest;

class MetaController extends AbstractController
{
    /**
     * This method returns the list of metas.
     *
     * optional http params:
     * - paginate: If you set paginate parameter, the result will be returned paginated.
     *
     * @param  MetaQueryFilter $filter  An object that builds search query
     * @param  Request         $request Laravel request object, this holds all data about request. Automatically populated.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(MetaQueryFilter $filter, Request $request)
    {
        $data = MetaService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
     * This method receives ID for the related model and returns the item to the client.
     *
     * @param  $metaId
     * @return mixed|null
     * @throws \Laravel\Octane\Exceptions\DdException
     */
    public function show($ref)
    {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = MetaService::getByRef($ref);

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
        $objects = MetaService::getSubObjects($ref, $subObject);

        return ResponsableFactory::makeResponse($this, $objects);
    }

    /**
     * This method created Meta object on database.
     *
     * @param  MetaCreateRequest $request
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function store(MetaCreateRequest $request)
    {
        $model = MetaService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
     * This method updates Meta object on database.
     *
     * @param  $metaId
     * @param  CountryCreateRequest $request
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function update($metaId, MetaUpdateRequest $request)
    {
        $model = MetaService::update($metaId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
     * This method updates Meta object on database.
     *
     * @param  $metaId
     * @param  CountryCreateRequest $request
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function destroy($metaId)
    {
        $model = MetaService::delete($metaId);

        return $this->noContent();
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
