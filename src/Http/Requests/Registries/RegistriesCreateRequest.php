<?php

namespace NextDeveloper\Commons\Http\Requests\Registries;

use JetBrains\PhpStorm\ArrayShape;
use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class RegistriesCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    #[ArrayShape(['key' => "string", 'value' => "string"])]
    public function rules()
    {
        return [
            'key' => 'required|string',
        'value' => 'required',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}
