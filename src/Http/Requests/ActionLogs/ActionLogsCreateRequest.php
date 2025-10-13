<?php

namespace NextDeveloper\Commons\Http\Requests\ActionLogs;

use JetBrains\PhpStorm\ArrayShape;
use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class ActionLogsCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    #[ArrayShape(['common_action_id' => "string", 'log' => "string", 'runtime' => "string"])]
    public function rules()
    {
        return [
            'common_action_id' => 'required|exists:common_actions,uuid|uuid',
        'log' => 'required',
        'runtime' => 'nullable|integer',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}
