<?php

namespace NextDeveloper\Commons\Http\Requests\Actions;

use JetBrains\PhpStorm\ArrayShape;
use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class ActionsCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'action' => 'required|string',
        'progress' => 'integer',
        'runtime' => 'nullable|integer',
        'object_id' => 'required',
        'object_type' => 'required|string',
        'tags' => '',
        'checkpoints' => 'nullable',
        'state_data' => 'nullable',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}