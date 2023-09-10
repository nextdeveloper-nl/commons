<?php

namespace NextDeveloper\Commons\Http\Requests\Votes;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class VotesUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'value'         => 'nullable|boolean',
			'voteable_id'   => 'nullable|exists:voteables,uuid|uuid',
			'voteable_type' => 'nullable|string|max:255',
			'iam_user_id'   => 'nullable|exists:iam_users,uuid|uuid',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n
}