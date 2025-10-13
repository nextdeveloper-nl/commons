<?php

namespace NextDeveloper\Commons\Http\Requests\ExchangeRates;

use JetBrains\PhpStorm\ArrayShape;
use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class ExchangeRatesCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    #[ArrayShape(['common_country_id' => "string", 'reference_currency_code' => "string", 'rate' => "string", 'source' => "string", 'local_currency_code' => "string"])]
    public function rules()
    {
        return [
            'common_country_id' => 'required|exists:common_countries,uuid|uuid',
        'reference_currency_code' => 'required|string',
        'rate' => 'required',
        'source' => 'nullable|string',
        'local_currency_code' => 'nullable|string',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}
