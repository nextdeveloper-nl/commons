<?php

namespace NextDeveloper\Commons\Http\Requests\CommonDomain;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CommonDomainUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'iam_account_id'   => 'nullable|exists:iam_accounts,uuid|uuid',
			'iam_user_id'      => 'nullable|exists:iam_users,uuid|uuid',
			'name'             => 'nullable|string|max:500',
			'is_active'        => 'boolean',
			'is_local_domain'  => 'boolean',
			'is_locked'        => 'boolean',
			'is_shared_domain' => 'boolean',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}