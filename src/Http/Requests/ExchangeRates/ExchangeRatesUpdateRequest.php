<?php

namespace NextDeveloper\Commons\Http\Requests\ExchangeRates;

use JetBrains\PhpStorm\ArrayShape;
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
        'rate' => 'nullable',
        'reference_currency_code' => 'nullable|string',
        'source' => 'nullable|string',
        'local_currency_code' => 'nullable|string',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n

}