<?php

namespace NextDeveloper\Commons\Http\Requests\SocialMedia;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class SocialMediaCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'object_id'          => 'required',
        'object_type'        => 'required|string|max:500',
        'profile_url'        => 'string|max:250',
        'is_invoice_address' => 'boolean',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}