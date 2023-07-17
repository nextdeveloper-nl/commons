<?php

namespace NextDeveloper\Commons\Http\Transformers;

use NextDeveloper\Commons\Database\Models\CommonMetum;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CommonMetumTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonMetumTransformer extends AbstractTransformer {

    /**
     * @param CommonMetum $model
     *
     * @return array
     */
    public function transform(CommonMetum $model) {
        return $this->buildPayload([
            'id'  =>  $model->id,
            'metable_id'  =>  $model->metable_id,
            'metable_type'  =>  $model->metable_type,
            'key'  =>  $model->key,
            'value'  =>  $model->value,
        ]);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}