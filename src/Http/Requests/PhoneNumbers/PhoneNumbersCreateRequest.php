<?php

namespace NextDeveloper\Commons\Http\Requests\PhoneNumbers;

use JetBrains\PhpStorm\ArrayShape;
use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class PhoneNumbersCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    #[ArrayShape(['object_id' => "string", 'object_type' => "string", 'name' => "string", 'code' => "string", 'number' => "string", 'is_active' => "string", 'common_country_id' => "string", 'tags' => "string"])]
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
        'tags' => '',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}
