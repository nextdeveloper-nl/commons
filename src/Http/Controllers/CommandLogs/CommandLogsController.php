<?php

namespace NextDeveloper\Commons\Http\Controllers\CommandLogs;

use Illuminate\Http\Request;
use NextDeveloper\Commons\Database\Filters\CommandLogsQueryFilter;
use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Commons\Http\Response\ResponsableFactory;
use NextDeveloper\Commons\Services\CommandLogsService;

/**
 * Read-only view of the command history. Rows are written by the CommandHistory middleware and CommandLogsService::record(),
 * never through the API.
 */
class CommandLogsController extends AbstractController
{
    /**
     * Lists the command history of the account (all accounts for platform administrators, by AuthorizationScope).
     *
     * Filters: module, resource, operation, action, object_type, object_id, source, status, iam_user_id (uuid),
     * created_at_start, created_at_end. Add "paginate" to paginate. Newest first.
     */
    public function index(CommandLogsQueryFilter $filter, Request $request)
    {
        $data = CommandLogsService::get($filter, $request->all());

        return ResponsableFactory::makeResponse($this, $data);
    }

    /** One entry by its uuid. */
    public function show($ref)
    {
        $model = CommandLogsService::getByRef($ref);

        return ResponsableFactory::makeResponse($this, $model);
    }
}
