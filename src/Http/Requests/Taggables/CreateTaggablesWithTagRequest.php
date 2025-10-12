<?php

namespace NextDeveloper\Commons\Http\Requests\Taggables;

use JetBrains\PhpStorm\ArrayShape;
use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CreateTaggablesWithTagRequest extends AbstractFormRequest
{
    /**
     * @return array
     */
    #[ArrayShape(['tag' => "string", 'object_id' => "string", 'object_type' => "string"])]
    public function rules()
    {
        return [
            'tag'           => 'required|string',
            'object_id'     => 'required',
            'object_type'   => 'required|string|max:500',
        ];
    }
}
