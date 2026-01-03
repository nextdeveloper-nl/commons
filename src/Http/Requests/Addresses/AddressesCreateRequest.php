<?php

namespace NextDeveloper\Commons\Http\Requests\Addresses;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class AddressesCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'object_id' => 'required',
            'object_type' => 'required|string',
            'name' => 'string',
            'line1' => 'required|string',
            'line2' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'nullable|string',
            'state_code' => 'nullable|string',
            'postcode' => 'nullable|string',
            'is_invoice_address' => 'boolean',
            'common_country_id' => 'required|exists:common_countries,uuid|uuid',
            'email_address' => 'nullable|string',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n


}
