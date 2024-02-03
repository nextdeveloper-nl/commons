<?php

namespace NextDeveloper\Commons\Http\Requests\Cities;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CitiesUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'nullable|string',
        'locale' => 'nullable|string',
        'name' => 'nullable|string',
        'phone_code' => 'nullable|string',
        'geo_name_identitiy' => 'nullable|integer',
        'is_active' => 'boolean',
        'timezones' => 'nullable',
        'common_country_id' => 'nullable|exists:common_countries,uuid|uuid',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}