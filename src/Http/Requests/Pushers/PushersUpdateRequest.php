<?php

namespace NextDeveloper\Commons\Http\Requests\Pushers;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class PushersUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'nullable|string',
        'description' => 'nullable|string',
        'require_auth' => 'boolean',
        'token' => 'nullable|string',
        'url' => 'nullable|string',
        'method' => 'string',
        'provider' => 'string',
        'provider_metadata' => 'nullable',
        'auth_header' => 'string',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}