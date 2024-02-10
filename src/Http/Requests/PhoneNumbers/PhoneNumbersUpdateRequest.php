<?php

namespace NextDeveloper\Commons\Http\Requests\PhoneNumbers;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class PhoneNumbersUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'object_id' => 'nullable',
        'object_type' => 'nullable|string',
        'name' => 'nullable|string',
        'code' => 'nullable|string',
        'number' => 'nullable|string',
        'is_active' => 'boolean',
        'common_country_id' => 'nullable|exists:common_countries,uuid|uuid',
        'tags' => '',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}