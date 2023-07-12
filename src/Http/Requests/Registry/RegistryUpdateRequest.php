<?php

namespace NextDeveloper\Commons\Http\Requests\Registry;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class RegistryUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'key'   => 'nullable|string|max:255',
			'value' => 'nullable|string',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}