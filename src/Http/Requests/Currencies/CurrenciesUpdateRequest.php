<?php

namespace NextDeveloper\Commons\Http\Requests\Currencies;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CurrenciesUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'code'              => 'nullable|string|max:3',
        'name'              => 'nullable|string|max:45',
        'common_country_id' => 'nullable|exists:common_countries,uuid|uuid',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}