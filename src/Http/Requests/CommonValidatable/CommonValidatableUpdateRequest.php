<?php

namespace NextDeveloper\Commons\Http\Requests\CommonValidatable;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CommonValidatableUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'validatable_id'   => 'nullable|exists:validatables,uuid|uuid',
			'validatable_type' => 'nullable|string|max:500',
			'validation_code'  => 'string|max:250',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}