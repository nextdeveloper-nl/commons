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
            'name'       => 'nullable|string|max:255',
        'value'      => 'nullable|string',
        'reason'     => 'nullable|string',
        'model_id'   => 'nullable|exists:models,uuid|uuid',
        'model_type' => 'nullable|string|max:191',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n
}