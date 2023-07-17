<?php

namespace NextDeveloper\Commons\Http\Requests\CommonDisposableEmail;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CommonDisposableEmailCreateRequest extends AbstractFormRequest
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