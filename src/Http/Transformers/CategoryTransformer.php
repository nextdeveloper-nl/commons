<?php

namespace NextDeveloper\Commons\Http\Transformers;

use NextDeveloper\Commons\Database\Models\Category;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CategoryTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CategoryTransformer extends AbstractTransformer {

    /**
     * @param Category $model
     *
     * @return array
     */
    public function transform(Category $model) {
        return $this->buildPayload([
            'id'  =>  $model->uuid,
            'slug'  =>  $model->slug,
            'name'  =>  $model->name,
            'description'  =>  $model->description,
            'url'  =>  $model->url,
            'is_active'  =>  $model->is_active,
            'domain_id'  =>  $model->domain_id,
            'user_id'  =>  $model->user_id,
            'parent_id'  =>  $model->parent_id,
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