<?php

namespace NextDeveloper\Commons\Http\Requests\CommonCreditCard;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CommonCreditCardCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'type'                 => 'required|string|max:20',
			'cc_holder_name'       => 'required|string|max:100',
			'cc_number'            => 'required|string|max:255',
			'cc_month'             => 'required|string|max:2',
			'cc_year'              => 'required|string|max:4',
			'cc_cvv'               => 'required|string|max:4',
			'is_default'           => 'boolean',
			'is_valid'             => 'boolean',
			'is_active'            => 'boolean',
			'score'                => 'boolean',
			'is_3d_secure_enabled' => 'boolean',
			'retry_count'          => 'boolean',
			'iam_account_id'           => 'nullable|exists:accounts,uuid|uuid',
			'iam_user_id'              => 'nullable|exists:users,uuid|uuid',
			'last_retry_date'      => 'nullable|date',
			'verification_date'    => 'nullable|date',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}