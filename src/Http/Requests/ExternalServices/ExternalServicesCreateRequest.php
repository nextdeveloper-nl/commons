<?php

namespace NextDeveloper\Commons\Http\Requests\ExternalServices;

use JetBrains\PhpStorm\ArrayShape;
use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class ExternalServicesCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    #[ArrayShape(['code' => "string", 'name' => "string", 'description' => "string", 'configuration' => "string", 'token' => "string", 'refresh_token' => "string", 'is_alive' => "string", 'service_owner' => "string"])]
    public function rules()
    {
        return [
            'code' => 'nullable|string',
        'name' => 'required|string',
        'description' => 'nullable|string',
        'configuration' => 'nullable',
        'token' => 'required|string',
        'refresh_token' => 'nullable|string',
        'is_alive' => 'nullable|boolean',
        'service_owner' => 'nullable|string',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}
