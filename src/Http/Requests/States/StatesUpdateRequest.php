<?php

namespace NextDeveloper\Commons\Http\Requests\States;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class StatesUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'object_states' => 'nullable',
        'name' => 'nullable|string',
        'value' => 'nullable|string',
        'reason' => 'nullable|string',
        'object_id' => 'nullable',
        'object_type' => 'nullable|string',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}