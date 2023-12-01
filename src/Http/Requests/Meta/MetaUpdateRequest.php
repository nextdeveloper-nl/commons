<?php

namespace NextDeveloper\Commons\Http\Requests\Meta;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class MetaUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'object_id'   => 'nullable',
        'object_type' => 'nullable|string|max:255',
        'key'         => 'nullable|string|max:255',
        'value'       => 'nullable|string',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}