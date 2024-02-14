<?php

namespace NextDeveloper\Commons\Http\Requests\Actions;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class ActionsUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'action' => 'nullable|string',
        'progress' => 'integer',
        'runtime' => 'nullable|integer',
        'object_id' => 'nullable',
        'object_type' => 'nullable|string',
        'tags' => '',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}