<?php

namespace NextDeveloper\Commons\Http\Requests\Vote;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class VoteCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'value'         => 'required|boolean',
			'voteable_id'   => 'required|exists:voteables,uuid|uuid',
			'voteable_type' => 'required|string|max:255',
			'iam_user_id'       => 'required|exists:users,uuid|uuid',
			'iam_account_id'    => 'required|exists:accounts,uuid|uuid',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}