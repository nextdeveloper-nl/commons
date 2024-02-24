<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\Categories;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CategoriesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractCategoriesTransformer extends AbstractTransformer
{

    /**
     * @param Categories $model
     *
     * @return array
     */
    public function transform(Categories $model)
    {
                        $commonDomainId = \NextDeveloper\Commons\Database\Models\Domains::where('id', $model->common_domain_id)->first();
                    $commonCategoryId = \NextDeveloper\Commons\Database\Models\Categories::where('id', $model->common_category_id)->first();
        
        return $this->buildPayload(
            [
            'id'  =>  $model->uuid,
            'slug'  =>  $model->slug,
            'name'  =>  $model->name,
            'description'  =>  $model->description,
            'url'  =>  $model->url,
            'is_active'  =>  $model->is_active,
            'common_domain_id'  =>  $commonDomainId ? $commonDomainId->uuid : null,
            'common_category_id'  =>  $commonCategoryId ? $commonCategoryId->uuid : null,
            'order'  =>  $model->order,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
            'deleted_at'  =>  $model->deleted_at,
            ]
        );
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n































































}
