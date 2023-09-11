<?php

namespace NextDeveloper\Commons\Http\Requests\Registries;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class RegistriesUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'key'   => 'nullable|string|max:255',
        'value' => 'nullable|string',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n
}