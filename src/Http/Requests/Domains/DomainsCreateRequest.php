<?php

namespace NextDeveloper\Commons\Http\Requests\Domains;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class DomainsCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
        'is_local_domain' => 'boolean',
        'tags' => '',
        'description' => 'nullable|string',
        'is_tld' => 'boolean',
        'common_country_id' => 'nullable|exists:common_countries,uuid|uuid',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}