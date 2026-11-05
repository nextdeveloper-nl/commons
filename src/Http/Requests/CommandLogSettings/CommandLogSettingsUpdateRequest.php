<?php

namespace NextDeveloper\Commons\Http\Requests\CommandLogSettings;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

/**
 * Body of PATCH /commons/command-log-settings. Only the keys sent change. delete is not accepted: it is always logged.
 */
class CommandLogSettingsUpdateRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'create' => 'sometimes|boolean',
            'update' => 'sometimes|boolean',
            'read' => 'sometimes|boolean',
        ];
    }
}
