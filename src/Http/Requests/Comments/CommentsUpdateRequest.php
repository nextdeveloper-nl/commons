<?php

namespace NextDeveloper\Commons\Http\Requests\Comments;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CommentsUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'body'        => 'nullable|string',
        'iam_user_id' => 'nullable|exists:iam_users,uuid|uuid',
        'object_id'   => 'nullable|exists:objects,uuid|uuid',
        'object_type' => 'nullable|string|max:255',
        '_lft'        => 'nullable|integer',
        '_rgt'        => 'nullable|integer',
        'parent_id'   => 'nullable|exists:parents,uuid|uuid',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}