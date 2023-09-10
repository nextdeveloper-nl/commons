<?php

namespace NextDeveloper\Commons\Http\Requests\States;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class StatesCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'name'       => 'required|string|max:255',
			'value'      => 'nullable|string',
			'reason'     => 'nullable|string',
			'model_id'   => 'required|exists:models,uuid|uuid',
			'model_type' => 'required|string|max:191',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n
}