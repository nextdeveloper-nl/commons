<?php

namespace NextDeveloper\Commons\Http\Requests\CommonLanguage;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CommonLanguageCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'iso_639_1_code'  => 'nullable|string|max:2',
			'iso_639_2_code'  => 'nullable|string|max:3',
			'iso_639_2b_code' => 'nullable|string|max:3',
			'code'            => 'nullable|string|max:2',
			'code_v2'         => 'nullable|string|max:3',
			'code_v2b'        => 'nullable|string|max:3',
			'name'            => 'required|string|max:100',
			'native_name'     => 'nullable|string|max:100',
			'is_default'      => 'boolean',
			'is_active'       => 'boolean',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}