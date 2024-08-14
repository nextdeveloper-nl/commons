<?php

namespace NextDeveloper\Commons\Http\Requests\AvailableActions;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class AvailableActionsCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'action' => 'required|string',
        'description' => 'required|string',
        'class' => 'required|string',
        'input' => 'nullable|string',
        'parameters' => 'required',
        'outputs' => 'nullable',
        'name' => 'nullable|string',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}