<?php

namespace NextDeveloper\Commons\Http\Requests\DisposableEmail;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class DisposableEmailUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'domain_id' => 'nullable|exists:domains,uuid|uuid',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}