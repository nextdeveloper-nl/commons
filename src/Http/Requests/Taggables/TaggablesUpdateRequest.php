<?php

namespace NextDeveloper\Commons\Http\Requests\Taggables;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class TaggablesUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'common_tags_id' => 'nullable|exists:common_tags,uuid|uuid',
        'object_id'      => 'nullable|exists:objects,uuid|uuid',
        'object_type'    => 'nullable|string|max:500',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}