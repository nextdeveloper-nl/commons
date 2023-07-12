<?php

namespace NextDeveloper\Commons\Http\Requests\Domain;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class DomainCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'account_id'       => 'nullable|exists:accounts,uuid|uuid',
			'name'             => 'required|string|max:500',
			'is_active'        => 'boolean',
			'is_local_domain'  => 'boolean',
			'is_locked'        => 'boolean',
			'is_shared_domain' => 'boolean',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}