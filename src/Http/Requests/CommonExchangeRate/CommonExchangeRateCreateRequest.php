<?php

namespace NextDeveloper\Commons\Http\Requests\CommonExchangeRate;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CommonExchangeRateCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'country_id'    => 'required|exists:countries,uuid|uuid',
			'code'          => 'required',
			'rate'          => 'required|numeric',
			'last_modified' => 'nullable|date',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}