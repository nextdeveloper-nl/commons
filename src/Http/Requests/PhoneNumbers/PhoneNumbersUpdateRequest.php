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
            'object_id'         => 'nullable',
        'object_type'       => 'nullable|string|max:255',
        'name'              => 'string|max:100',
        'code'              => 'nullable|string|max:10',
        'number'            => 'nullable|string|max:100',
        'is_active'         => 'boolean',
        'common_country_id' => 'nullable|exists:common_countries,uuid|uuid',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}