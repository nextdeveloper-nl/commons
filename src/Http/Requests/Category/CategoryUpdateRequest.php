<?php

namespace NextDeveloper\Commons\Http\Requests\Category;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CategoryUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'slug'        => 'nullable|string|max:500',
			'name'        => 'nullable|string|max:500',
			'description' => 'nullable|string',
			'url'         => 'nullable|string|max:500',
			'is_active'   => 'boolean',
			'domain_id'   => 'nullable|exists:domains,uuid|uuid',
			'user_id'     => 'nullable|exists:users,uuid|uuid',
			'parent_id'   => 'nullable|exists:parents,uuid|uuid',
			'_lft'        => 'nullable|integer',
			'_rgt'        => 'nullable|integer',
			'order'       => 'integer',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}