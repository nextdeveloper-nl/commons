<?php

namespace NextDeveloper\Commons\Http\Transformers;

use NextDeveloper\Commons\Database\Models\CommonTaggable;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CommonTaggableTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonTaggableTransformer extends AbstractTransformer {

    /**
     * @param CommonTaggable $model
     *
     * @return array
     */
    public function transform(CommonTaggable $model) {
        return $this->buildPayload([
            'id'  =>  $model->id,
            'tag_id'  =>  $model->tag_id,
            'taggable_id'  =>  $model->taggable_id,
            'taggable_type'  =>  $model->taggable_type,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
        ]);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}