<?php

namespace NextDeveloper\Commons\Http\Requests\Registries;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class RegistriesCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'key'   => 'required|string|max:255',
			'value' => 'required|string',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n
}