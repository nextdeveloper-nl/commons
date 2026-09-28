<?php

namespace NextDeveloper\Commons\Http\Requests\Pushers;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class PushersCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
        'description' => 'nullable|string',
        'require_auth' => 'boolean',
        'token' => 'nullable|string',
        'url' => 'required|string',
        'method' => 'string',
        'provider' => 'string',
        'provider_metadata' => 'nullable',
        'auth_header' => 'string',
        'is_retryable' => 'boolean',
        // disabled_at is set by PushersService; re-enabling clears disabled_at/disabled_reason.
        'status' => 'nullable|string|in:active,disabled',
        'disabled_reason' => 'nullable|string',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}