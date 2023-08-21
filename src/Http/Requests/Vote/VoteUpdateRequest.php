<?php

namespace NextDeveloper\Commons\Http\Requests\Vote;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class VoteUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'value'         => 'nullable|boolean',
			'voteable_id'   => 'nullable|exists:voteables,uuid|uuid',
			'voteable_type' => 'nullable|string|max:255',
			'iam_user_id'       => 'nullable|exists:users,uuid|uuid',
			'iam_account_id'    => 'nullable|exists:accounts,uuid|uuid',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}