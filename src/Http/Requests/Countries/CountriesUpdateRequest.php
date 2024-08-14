<?php

namespace NextDeveloper\Commons\Http\Requests\Countries;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CountriesUpdateRequest extends AbstractFormRequest
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
        'currency_code' => 'nullable|string',
        'phone_code' => 'nullable|string',
        'continent_name' => 'nullable|string',
        'continent_code' => 'nullable|string',
        'geo_name_identity' => 'nullable|integer',
        'is_active' => 'boolean',
        'timezones' => 'nullable',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}