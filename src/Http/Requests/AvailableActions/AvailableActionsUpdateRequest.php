<?php

namespace NextDeveloper\Commons\Http\Requests\AvailableActions;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class AvailableActionsUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'action' => 'nullable|string',
        'description' => 'nullable|string',
        'class' => 'nullable|string',
        'input' => 'nullable|string',
        'parameters' => 'nullable',
        'outputs' => 'nullable',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}