<?php

namespace NextDeveloper\Commons\Http\Requests\AvailableActions;

use JetBrains\PhpStorm\ArrayShape;
use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class AvailableActionsUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    #[ArrayShape(['action' => "string", 'description' => "string", 'class' => "string", 'input' => "string", 'parameters' => "string", 'outputs' => "string", 'name' => "string"])]
    public function rules()
    {
        return [
            'action' => 'nullable|string',
        'description' => 'nullable|string',
        'class' => 'nullable|string',
        'input' => 'nullable|string',
        'parameters' => 'nullable',
        'outputs' => 'nullable',
        'name' => 'nullable|string',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}
