<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\CommonCategory;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CommonCategoryTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractCommonCategoryTransformer extends AbstractTransformer {

    /**
     * @param CommonCategory $model
     *
     * @return array
     */
    public function transform(CommonCategory $model) {
                        $commonDomainId = \NextDeveloper\Commons\Database\Models\CommonDomain::where('id', $model->common_domain_id)->first();
                    $commonCategoriesParentId = \NextDeveloper\Commons\Database\Models\CommonCategoriesParent::where('id', $model->common_categories_parent_id)->first();
            
        return $this->buildPayload([
'id'  =>  $model->uuid,
'slug'  =>  $model->slug,
'name'  =>  $model->name,
'description'  =>  $model->description,
'url'  =>  $model->url,
'is_active'  =>  $model->is_active,
'common_domain_id'  =>  $commonDomainId ? $commonDomainId->uuid : null,
'common_categories_parent_id'  =>  $commonCategoriesParentId ? $commonCategoriesParentId->uuid : null,
'_lft'  =>  $model->_lft,
'_rgt'  =>  $model->_rgt,
'order'  =>  $model->order,
'created_at'  =>  $model->created_at,
'updated_at'  =>  $model->updated_at,
'deleted_at'  =>  $model->deleted_at,
    ]);
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}
