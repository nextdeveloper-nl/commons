<?php

namespace NextDeveloper\Commons\Http\Requests\States;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class StatesCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
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