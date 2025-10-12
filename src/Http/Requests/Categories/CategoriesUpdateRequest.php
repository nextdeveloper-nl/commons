<?php

namespace NextDeveloper\Commons\Http\Requests\Categories;

use JetBrains\PhpStorm\ArrayShape;
use NextDeveloper\Commons\Http\Requests\AbstractFormRequest;

class CategoriesUpdateRequest extends AbstractFormRequest
{

    /**
     * @return array
     */
    #[ArrayShape(['slug' => "string", 'name' => "string", 'description' => "string", 'url' => "string", 'is_active' => "string", 'common_domain_id' => "string", 'common_category_id' => "string", 'position' => "string"])]
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
        'position' => 'integer',
        ];
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
}
