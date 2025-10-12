<?php

namespace NextDeveloper\Commons\Http\Requests\Cities;

use JetBrains\PhpStorm\ArrayShape;
use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CitiesUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    #[ArrayShape(['code' => "string", 'locale' => "string", 'name' => "string", 'phone_code' => "string", 'geo_name_identitiy' => "string", 'common_country_id' => "string", 'is_active' => "string", 'timezones' => "string"])]
    public function rules()
    {
        return [
            'code' => 'nullable|string',
        'locale' => 'nullable|string',
        'name' => 'nullable|string',
        'phone_code' => 'nullable|string',
        'geo_name_identitiy' => 'nullable|integer',
        'common_country_id' => 'nullable|exists:common_countries,uuid|uuid',
        'is_active' => 'boolean',
        'timezones' => 'nullable',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}
