<?php

namespace NextDeveloper\Commons\Http\Requests\SocialMedia;

use JetBrains\PhpStorm\ArrayShape;
use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class SocialMediaCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    #[ArrayShape(['object_id' => "string", 'object_type' => "string", 'profile_url' => "string", 'tags' => "string"])]
    public function rules()
    {
        return [
            'object_id' => 'required',
        'object_type' => 'required|string',
        'profile_url' => 'required|string',
        'tags' => '',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}
