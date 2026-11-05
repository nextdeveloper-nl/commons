<?php

namespace NextDeveloper\Commons\Http\Controllers\CommandLogSettings;

use NextDeveloper\Commons\Http\Controllers\AbstractController;
use NextDeveloper\Commons\Http\Requests\CommandLogSettings\CommandLogSettingsUpdateRequest;
use NextDeveloper\Commons\Http\Response\ResponsableFactory;
use NextDeveloper\Commons\Services\CommandLogSettingsService;

/**
 * Which operations the current account follows in its command history. Validates and delegates to the service.
 */
class CommandLogSettingsController extends AbstractController
{
    /** The effective settings: create, update, read (customer choice) and delete (always true). */
    public function show()
    {
        return ResponsableFactory::makeResponse($this, CommandLogSettingsService::forCurrentAccount());
    }

    /** Body: any of create, update, read as booleans. delete cannot be switched off. */
    public function update(CommandLogSettingsUpdateRequest $request)
    {
        return ResponsableFactory::makeResponse($this, CommandLogSettingsService::update($request->validated()));
    }
}
