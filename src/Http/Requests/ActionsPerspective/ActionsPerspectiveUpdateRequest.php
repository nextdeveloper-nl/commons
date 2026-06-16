<?php

namespace NextDeveloper\Commons\Http\Requests\ActionsPerspective;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class ActionsPerspectiveUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'action' => 'nullable|string',
        'progress' => 'nullable|integer',
        'runtime' => 'nullable|integer',
        'object_id' => 'nullable',
        'object_type' => 'nullable|string',
        'log' => 'nullable',
        'subaction_runtime' => 'nullable|integer',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}