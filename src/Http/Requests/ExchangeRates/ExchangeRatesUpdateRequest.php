<?php

namespace NextDeveloper\Commons\Http\Requests\ExchangeRates;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class ExchangeRatesUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'common_country_id' => 'nullable|exists:common_countries,uuid|uuid',
        'code'              => 'nullable',
        'rate'              => 'nullable|numeric',
        'last_modified'     => 'nullable|date',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}