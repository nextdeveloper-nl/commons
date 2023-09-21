<?php

namespace NextDeveloper\Commons\Http\Requests\Currencies;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CurrenciesCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'code'              => 'required|string|max:3',
        'name'              => 'required|string|max:45',
        'common_country_id' => 'nullable|exists:common_countries,uuid|uuid',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}