<?php

namespace NextDeveloper\Commons\Http\Requests\Tags;

use JetBrains\PhpStorm\ArrayShape;
use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class TagsCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    #[ArrayShape(['name' => "string", 'description' => "string", 'slug' => "string"])]
    public function rules()
    {
        return [
            'name' => 'required|string',
        'description' => 'nullable|string',
        'slug' => 'required|string',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n

}
