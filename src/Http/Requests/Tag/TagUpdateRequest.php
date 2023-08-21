<?php

namespace NextDeveloper\Commons\Http\Requests\Tag;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class TagUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'name'        => 'nullable|string|max:50',
			'description' => 'nullable|string|max:500',
			'slug'        => 'nullable|string|max:50',
			'type'        => '',
			'iam_user_id'     => 'nullable|exists:users,uuid|uuid',
			'iam_account_id'  => 'nullable|exists:accounts,uuid|uuid',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}