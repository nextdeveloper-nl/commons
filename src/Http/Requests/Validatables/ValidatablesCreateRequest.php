<?php

namespace NextDeveloper\Commons\Http\Requests\Validatables;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class ValidatablesCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'validatable_id'   => 'required|exists:validatables,uuid|uuid',
			'validatable_type' => 'required|string|max:500',
			'validation_code'  => 'string|max:250',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n
}