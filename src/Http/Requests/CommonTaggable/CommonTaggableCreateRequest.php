<?php

namespace NextDeveloper\Commons\Http\Requests\CommonTaggable;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CommonTaggableCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'tag_id'        => 'required|exists:tags,uuid|uuid',
			'taggable_id'   => 'required|exists:taggables,uuid|uuid',
			'taggable_type' => 'required|string|max:500',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}