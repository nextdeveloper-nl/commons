<?php

namespace NextDeveloper\Commons\Http\Requests\Taggables;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CreateTaggablesWithTagRequest extends AbstractFormRequest
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'tag'           => 'required|string',
            'object_id'     => 'required',
            'object_type'   => 'required|string|max:500',
        ];
    }
}
