<?php

namespace NextDeveloper\Commons\Http\Requests\CommonSocialMedia;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CommonSocialMediaCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'sociable_id'        => 'required|exists:sociables,uuid|uuid',
			'sociable_type'      => 'required|string|max:500',
			'profile_url'        => 'string|max:250',
			'is_invoice_address' => 'boolean',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}