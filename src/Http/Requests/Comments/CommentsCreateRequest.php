<?php

namespace NextDeveloper\Commons\Http\Requests\Comments;

use JetBrains\PhpStorm\ArrayShape;
use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CommentsCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    #[ArrayShape(['body' => "string", 'object_id' => "string", 'object_type' => "string", 'tags' => "string"])]
    public function rules()
    {
        return [
            'body' => 'required|string',
        'object_id' => 'required',
        'object_type' => 'required|string',
        'tags' => '',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}
