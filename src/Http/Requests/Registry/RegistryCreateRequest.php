<?php

namespace NextDeveloper\Commons\Http\Requests\Registry;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class RegistryCreateRequest extends AbstractFormRequest
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
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}