<?php

namespace NextDeveloper\Commons\Http\Requests\Tags;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class TagsCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name'           => 'required|string|max:50',
        'description'    => 'nullable|string|max:500',
        'slug'           => 'required|string|max:50',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n

}