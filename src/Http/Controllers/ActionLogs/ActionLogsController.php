<?php

namespace NextDeveloper\Commons\Http\Controllers\ActionLogs;

use Illuminate\Http\Request;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Commons\Http\Response\ResponsableFactory;
use NextDeveloper\Commons\Http\Requests\ActionLogs\ActionLogsUpdateRequest;
use NextDeveloper\Commons\Database\Filters\ActionLogsQueryFilter;
use NextDeveloper\Commons\Database\Models\ActionLogs;
use NextDeveloper\Commons\Services\ActionLogsService;
use NextDeveloper\Commons\Http\Requests\ActionLogs\ActionLogsCreateRequest;
use NextDeveloper\Commons\Http\Traits\Tags;use NextDeveloper\Commons\Http\Traits\Addresses;
class ActionLogsController extends AbstractController
{
    private $model = ActionLogs::class;

    use Tags;
    use Addresses;
    /**
     * This method returns the list of actionlogs.
     *
     * optional http params:
     * - paginate: If you set paginate parameter, the result will be returned paginated.
     *
     * @param  ActionLogsQueryFilter $filter  An object that builds search query
     * @param  Request               $request Laravel request object, this holds all data about request. Automatically populated.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ActionLogsQueryFilter $filter, Request $request)
    {
        $data = ActionLogsService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /**
     * This method receives ID for the related model and returns the item to the client.
     *
     * @param  $actionLogsId
     * @return mixed|null
     * @throws \Laravel\Octane\Exceptions\DdException
     */
    public function show($ref)
    {
        //  Here we are not using Laravel Route Model Binding. Please check routeBinding.md file
        //  in NextDeveloper Platform Project
        $model = ActionLogsService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
     * This method returns the list of sub objects the related object. Sub object means an object which is preowned by
     * this object.
     *
     * It can be tags, addresses, states etc.
     *
     * @param  $ref
     * @param  $subObject
     * @return void
     */
    public function relatedObjects($ref, $subObject)
    {
        $objects = ActionLogsService::relatedObjects($ref, $subObject);

        return ResponsableFactory::makeResponse($this, $objects);
    }

    /**
     * This method created ActionLogs object on database.
     *
     * @param  ActionLogsCreateRequest $request
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function store(ActionLogsCreateRequest $request)
    {
        $model = ActionLogsService::create($request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
     * This method updates ActionLogs object on database.
     *
     * @param  $actionLogsId
     * @param  CountryCreateRequest $request
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function update($actionLogsId, ActionLogsUpdateRequest $request)
    {
        $model = ActionLogsService::update($actionLogsId, $request->validated());

        return ResponsableFactory::makeResponse($this, $model);
    }

    /**
     * This method updates ActionLogs object on database.
     *
     * @param  $actionLogsId
     * @param  CountryCreateRequest $request
     * @return mixed|null
     * @throws \NextDeveloper\Commons\Exceptions\CannotCreateModelException
     */
    public function destroy($actionLogsId)
    {
        $model = ActionLogsService::delete($actionLogsId);

        return $this->noContent();
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
