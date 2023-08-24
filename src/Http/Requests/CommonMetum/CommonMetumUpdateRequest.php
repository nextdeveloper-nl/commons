<?php

namespace NextDeveloper\Commons\Http\Requests\CommonMetum;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CommonMetumUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'metable_id'   => 'nullable|exists:metables,uuid|uuid',
			'metable_type' => 'nullable|string|max:255',
			'key'          => 'nullable|string|max:255',
			'value'        => 'nullable|string',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}