<?php

namespace NextDeveloper\Commons\Http\Requests\CommonDisposableEmail;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CommonDisposableEmailUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'common_domain_id' => 'nullable|exists:common_domains,uuid|uuid',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}