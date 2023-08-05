<?php

namespace NextDeveloper\Commons\Http\Requests\CommonDomainable;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CommonDomainableCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'domainable_id'   => 'required|exists:domainables,uuid|uuid',
			'domainable_type' => 'required|string|max:255',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}