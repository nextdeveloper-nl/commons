<?php

namespace NextDeveloper\Commons\Http\Requests\Comments;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CommentsCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'body'        => 'required|string',
        'iam_user_id' => 'required|exists:iam_users,uuid|uuid',
        'object_id'   => 'required|exists:objects,uuid|uuid',
        'object_type' => 'required|string|max:255',
        '_lft'        => 'required|integer',
        '_rgt'        => 'required|integer',
        'parent_id'   => 'nullable|exists:parents,uuid|uuid',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}