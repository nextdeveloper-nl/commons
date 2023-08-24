<?php

namespace NextDeveloper\Commons\Http\Requests\CommonRegistry;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CommonRegistryUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'key'   => 'nullable|string|max:255',
			'value' => 'nullable|string',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}