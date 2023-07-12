<?php

namespace NextDeveloper\Commons\Http\Requests\DisposableEmail;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class DisposableEmailCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'domain_id' => 'required|exists:domains,uuid|uuid',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}