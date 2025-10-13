<?php

namespace NextDeveloper\Commons\Http\Requests\Domainables;

use JetBrains\PhpStorm\ArrayShape;
use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class DomainablesCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    #[ArrayShape(['object_id' => "string", 'object_type' => "string"])]
    public function rules()
    {
        return [
            'object_id'   => 'required',
        'object_type' => 'required|string|max:255',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}
