<?php

namespace NextDeveloper\Commons\Http\Requests\Category;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CategoryCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'slug'        => 'nullable|string|max:500',
			'name'        => 'required|string|max:500',
			'description' => 'required|string',
			'url'         => 'nullable|string|max:500',
			'is_active'   => 'boolean',
			'domain_id'   => 'required|exists:domains,uuid|uuid',
			'iam_user_id'     => 'required|exists:users,uuid|uuid',
			'parent_id'   => 'nullable|exists:parents,uuid|uuid',
			'_lft'        => 'required|integer',
			'_rgt'        => 'required|integer',
			'order'       => 'integer',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}