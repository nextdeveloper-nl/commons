<?php

namespace NextDeveloper\Commons\Http\Requests\Addresses;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class AddressesUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'object_id' => 'nullable',
        'object_type' => 'nullable|string',
        'name' => 'string',
        'line1' => 'nullable|string',
        'line2' => 'nullable|string',
        'city' => 'nullable|string',
        'state' => 'nullable|string',
        'state_code' => 'nullable|string',
        'postcode' => 'nullable|string',
        'is_invoice_address' => 'boolean',
        'common_country_id' => 'nullable|exists:common_countries,uuid|uuid',
        'email_address' => 'nullable|string',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n

}