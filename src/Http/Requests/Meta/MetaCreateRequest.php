<?php

namespace NextDeveloper\Commons\Http\Requests\Meta;

use JetBrains\PhpStorm\ArrayShape;
use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class MetaCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    #[ArrayShape(['object_id' => "string", 'object_type' => "string", 'key' => "string", 'value' => "string"])]
    public function rules()
    {
        return [
            'object_id' => 'required',
        'object_type' => 'required|string',
        'key' => 'required|string',
        'value' => 'required',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n

}
