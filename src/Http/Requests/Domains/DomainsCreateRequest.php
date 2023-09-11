<?php

namespace NextDeveloper\Commons\Http\Requests\Domains;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class DomainsCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'iam_account_id'   => 'required|exists:iam_accounts,uuid|uuid',
        'iam_user_id'      => 'required|exists:iam_users,uuid|uuid',
        'name'             => 'required|string|max:500',
        'is_active'        => 'boolean',
        'is_local_domain'  => 'boolean',
        'is_locked'        => 'boolean',
        'is_shared_domain' => 'boolean',
        'is_validated'     => 'boolean',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n
}