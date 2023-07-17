<?php

namespace NextDeveloper\Commons\Http\Requests\CommonComment;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CommonCommentUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'body'             => 'nullable|string',
			'user_id'          => 'nullable|exists:users,uuid|uuid',
			'commentable_id'   => 'nullable|exists:commentables,uuid|uuid',
			'commentable_type' => 'nullable|string|max:255',
			'_lft'             => 'nullable|integer',
			'_rgt'             => 'nullable|integer',
			'parent_id'        => 'nullable|exists:parents,uuid|uuid',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}