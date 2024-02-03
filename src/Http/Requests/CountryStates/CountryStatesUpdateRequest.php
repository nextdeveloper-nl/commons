<?php

namespace NextDeveloper\Commons\Http\Requests\CountryStates;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CountryStatesUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'nullable|string',
        'code' => 'nullable|string',
        'latitude' => 'nullable|string',
        'longitude' => 'nullable|string',
        'type' => 'nullable|string',
        'common_country_id' => 'nullable|exists:common_countries,uuid|uuid',
        'is_active' => 'boolean',
        'timezones' => 'nullable',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}