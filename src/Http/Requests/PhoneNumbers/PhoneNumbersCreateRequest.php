<?php

namespace NextDeveloper\Commons\Http\Requests\PhoneNumbers;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class PhoneNumbersCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'object_id' => 'required',
        'object_type' => 'required|string',
        'name' => 'required|string',
        'code' => 'required|string',
        'number' => 'required|string',
        'is_active' => 'boolean',
        'common_country_id' => 'required|exists:common_countries,uuid|uuid',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}