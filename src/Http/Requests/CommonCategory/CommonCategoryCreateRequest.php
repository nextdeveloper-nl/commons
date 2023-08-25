<?php

namespace NextDeveloper\Commons\Http\Requests\CommonCategory;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CommonCategoryCreateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules() {
        return [
            'slug'                        => 'required|string|max:500',
			'name'                        => 'required|string|max:500',
			'description'                 => 'required|string',
			'url'                         => 'nullable|string|max:500',
			'is_active'                   => 'boolean',
			'common_domain_id'            => 'required|exists:common_domains,uuid|uuid',
			'common_categories_parent_id' => 'nullable|exists:common_categories_parents,uuid|uuid',
			'_lft'                        => 'required|integer',
			'_rgt'                        => 'required|integer',
			'order'                       => 'integer',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}