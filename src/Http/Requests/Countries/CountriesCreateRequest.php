<?php

namespace NextDeveloper\Commons\Http\Requests\Countries;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CountriesCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'code'               => 'required|string|max:2',
        'locale'             => 'nullable|string|max:2',
        'name'               => 'required|string|max:45',
        'currency_code'      => 'nullable|string|max:3',
        'phone_code'         => 'nullable|string|max:5',
        'vat_rate'           => 'numeric',
        'continent_name'     => 'nullable|string|max:15',
        'continent_code'     => 'nullable|string|max:2',
        'geo_name_identitiy' => 'nullable|integer',
        'is_active'          => 'boolean',
        'timezones'          => 'nullable',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}