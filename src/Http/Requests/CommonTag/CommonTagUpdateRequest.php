<?php

namespace NextDeveloper\Commons\Http\Requests\CommonTag;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CommonTagUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'name'        => 'nullable|string|max:50',
			'description' => 'nullable|string|max:500',
			'slug'        => 'nullable|string|max:50',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}