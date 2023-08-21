<?php

namespace NextDeveloper\Commons\Http\Requests\CommonMetum;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CommonMetumCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'metable_id'   => 'required|exists:metables,uuid|uuid',
			'metable_type' => 'required|string|max:255',
			'key'          => 'required|string|max:255',
			'value'        => 'required|string',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n
}