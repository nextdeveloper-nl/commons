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
            'object_id'          => 'nullable',
        'object_type'        => 'nullable|string|max:255',
        'name'               => 'string|max:100',
        'line1'              => 'nullable|string|max:100',
        'line2'              => 'nullable|string|max:100',
        'city'               => 'nullable|string|max:100',
        'state'              => 'nullable|string|max:100',
        'state_code'         => 'nullable|string|max:100',
        'postcode'           => 'nullable|string|max:100',
        'is_invoice_address' => 'boolean',
        'common_country_id'  => 'nullable|exists:common_countries,uuid|uuid',
        'email_address'      => 'nullable|string|max:200',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}