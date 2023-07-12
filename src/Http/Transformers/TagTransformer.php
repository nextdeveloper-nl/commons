<?php

namespace NextDeveloper\Commons\Http\Transformers;

use NextDeveloper\Commons\Database\Models\Tag;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class TagTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class TagTransformer extends AbstractTransformer {

    /**
     * @param Tag $model
     *
     * @return array
     */
    public function transform(Tag $model) {
        return $this->buildPayload([
            'id'  =>  $model->uuid,
            'name'  =>  $model->name,
            'description'  =>  $model->description,
            'slug'  =>  $model->slug,
            'type'  =>  $model->type,
            'user_id'  =>  $model->user_id,
            'account_id'  =>  $model->account_id,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
            'deleted_at'  =>  $model->deleted_at,
        ]);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}