<?php

namespace NextDeveloper\Commons\Http\Requests\CommonExchangeRate;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CommonExchangeRateUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'country_id'    => 'nullable|exists:countries,uuid|uuid',
			'code'          => 'nullable',
			'rate'          => 'nullable|numeric',
			'last_modified' => 'nullable|date',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}