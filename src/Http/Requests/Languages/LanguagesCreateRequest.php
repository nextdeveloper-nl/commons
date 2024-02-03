<?php

namespace NextDeveloper\Commons\Http\Requests\Languages;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class LanguagesCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'iso_639_1_code' => 'nullable',
        'iso_639_2_code' => 'nullable',
        'iso_639_2b_code' => 'nullable',
        'code' => 'nullable',
        'code_v2' => 'nullable',
        'code_v2b' => 'nullable',
        'name' => 'required|string',
        'native_name' => 'nullable|string',
        'is_default' => 'boolean',
        'is_active' => 'boolean',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}