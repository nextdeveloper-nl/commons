<?php

namespace NextDeveloper\Commons\Http\Requests\CommonTaggable;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CommonTaggableUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'tag_id'        => 'nullable|exists:tags,uuid|uuid',
			'taggable_id'   => 'nullable|exists:taggables,uuid|uuid',
			'taggable_type' => 'nullable|string|max:500',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}