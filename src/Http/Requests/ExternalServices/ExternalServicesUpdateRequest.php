<?php

namespace NextDeveloper\Commons\Http\Requests\ExternalServices;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class ExternalServicesUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'nullable|string',
        'name' => 'nullable|string',
        'description' => 'nullable|string',
        'configuration' => 'nullable',
        'token' => 'nullable|string',
        'refresh_token' => 'nullable|string',
        'is_alive' => 'nullable|boolean',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}