<?php

namespace NextDeveloper\Commons\Http\Requests\Categories;

use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CategoriesUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'slug' => 'nullable|string',
        'name' => 'nullable|string',
        'description' => 'nullable|string',
        'url' => 'nullable|string',
        'is_active' => 'boolean',
        'common_domain_id' => 'nullable|exists:common_domains,uuid|uuid',
        'common_category_id' => 'nullable|exists:common_categories,uuid|uuid',
        'order' => 'integer',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}