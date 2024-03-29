<?php

namespace NextDeveloper\Commons\Http\Requests\ActionLogs;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class ActionLogsUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'common_action_id' => 'nullable|exists:common_actions,uuid|uuid',
        'log' => 'nullable',
        'runtime' => 'nullable|integer',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}