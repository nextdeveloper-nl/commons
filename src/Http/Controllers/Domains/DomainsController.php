<?php

namespace NextDeveloper\Commons\Http\Controllers\Domains;

use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Models\Domains;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Commons\Http\Traits\Tags;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\Domains\DomainsUpdateRequest;
use NextDeveloper\Commons\Database\Filters\DomainsQueryFilter;
use NextDeveloper\Commons\Services\DomainsService;
use NextDeveloper\Commons\Http\Requests\Domains\DomainsCreateRequest;

class DomainsController extends AbstractController
{
    use Tags;

    private $model = Domains::class;

    /**
     * This method returns the list of domains.
     *
     * optional http params:
     * - paginate: If you set paginate parameter, the result will be returned paginated.
     *
     * @param  DomainsQueryFilter $filter  An object that builds search query
     * @param  Request            $request Laravel request object, this holds all data about request. Automatically populated.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(DomainsQueryFilter $filter, Request $request)
    {
        $data = DomainsService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
     * This method receives ID for the related model and returns the item to the client.
     *
     * @param  $domainsId
     * @return mixed|null
     * @throws \Laravel\Octane\Exceptions\DdException
     */
    public function show($ref)
    {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = DomainsService::getByRef($ref);

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
        $objects = DomainsService::getSubObjects($ref, $subObject);

        return ResponsableFactory::makeResponse($this, $objects);
    }

    /**
     * This method created Domains object on database.
     *
     * @param  DomainsCreateRequest $request
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function store(DomainsCreateRequest $request)
    {
        $model = DomainsService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
     * This method updates Domains object on database.
     *
     * @param  $domainsId
     * @param  CountryCreateRequest $request
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function update($domainsId, DomainsUpdateRequest $request)
    {
        $model = DomainsService::update($domainsId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
     * This method updates Domains object on database.
     *
     * @param  $domainsId
     * @param  CountryCreateRequest $request
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function destroy($domainsId)
    {
        $model = DomainsService::delete($domainsId);

        return $this->noContent();
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
