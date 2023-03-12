<?php

namespace NextDeveloper\Commons\Http\Requests\Country;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CountryUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'code'           => 'required|string|max:2',
			'locale'         => 'nullable|string|max:2',
			'name'           => 'required|string|max:45',
			'currency_code'  => 'nullable|string|max:3',
			'phone_code'     => 'nullable|string|max:5',
			'rate'           => 'numeric',
			'percentage'     => 'numeric',
			'continent_name' => 'nullable|string|max:15',
			'continent_code' => 'nullable|string|max:2',
			'geo_name_code'  => 'nullable|integer',
			'is_active'      => 'boolean',
        ];
    }

}