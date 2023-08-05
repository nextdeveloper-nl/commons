<?php

namespace NextDeveloper\Commons\Http\Requests\CommonCategory;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CommonCategoryUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'slug'                        => 'nullable|string|max:500',
			'name'                        => 'nullable|string|max:500',
			'description'                 => 'nullable|string',
			'url'                         => 'nullable|string|max:500',
			'is_active'                   => 'boolean',
			'common_domain_id'            => 'nullable|exists:common_domains,uuid|uuid',
			'common_categories_parent_id' => 'nullable|exists:common_categories_parents,uuid|uuid',
			'_lft'                        => 'nullable|integer',
			'_rgt'                        => 'nullable|integer',
			'order'                       => 'integer',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}