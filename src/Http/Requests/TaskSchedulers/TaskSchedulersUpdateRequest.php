<?php

namespace NextDeveloper\Commons\Http\Requests\TaskSchedulers;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class TaskSchedulersUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'nullable|string',
        'description' => 'nullable|string',
        'next_run' => 'nullable|date',
        'object_name' => 'nullable|string',
        'object_id' => 'nullable',
        'common_available_action_id' => 'nullable|exists:common_available_actions,uuid|uuid',
        'params' => 'nullable',
        'last_run' => 'nullable|date',
        'output' => 'nullable|string',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}