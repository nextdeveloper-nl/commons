<?php

namespace NextDeveloper\Commons\Http\Requests\States;

use JetBrains\PhpStorm\ArrayShape;
use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class StatesCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    #[ArrayShape(['object_states' => "string", 'name' => "string", 'value' => "string", 'reason' => "string", 'object_id' => "string", 'object_type' => "string"])]
    public function rules()
    {
        return [
            'object_states' => 'required',
        'name' => 'required|string',
        'value' => 'nullable|string',
        'reason' => 'nullable|string',
        'object_id' => 'required',
        'object_type' => 'required|string',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}
