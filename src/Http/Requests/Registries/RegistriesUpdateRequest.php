<?php

namespace NextDeveloper\Commons\Http\Requests\Registries;

use JetBrains\PhpStorm\ArrayShape;
use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class RegistriesUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    #[ArrayShape(['key' => "string", 'value' => "string"])]
    public function rules()
    {
        return [
            'key' => 'nullable|string',
        'value' => 'nullable',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}
