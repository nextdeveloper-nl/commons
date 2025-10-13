<?php

namespace NextDeveloper\Commons\Http\Requests\Domains;

use JetBrains\PhpStorm\ArrayShape;
use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class DomainsUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    #[ArrayShape(['name' => "string", 'is_local_domain' => "string", 'tags' => "string", 'description' => "string", 'is_tld' => "string"])]
    public function rules()
    {
        return [
            'name' => 'nullable|string',
        'is_local_domain' => 'boolean',
        'tags' => '',
        'description' => 'nullable|string',
        'is_tld' => 'boolean',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}
