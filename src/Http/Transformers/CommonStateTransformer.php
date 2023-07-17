<?php

namespace NextDeveloper\Commons\Http\Transformers;

use NextDeveloper\Commons\Database\Models\CommonState;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CommonStateTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonStateTransformer extends AbstractTransformer {

    /**
     * @param CommonState $model
     *
     * @return array
     */
    public function transform(CommonState $model) {
        return $this->buildPayload([
            'id'  =>  $model->uuid,
            'name'  =>  $model->name,
            'value'  =>  $model->value,
            'reason'  =>  $model->reason,
            'model_id'  =>  $model->model_id,
            'model_type'  =>  $model->model_type,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
            'deleted_at'  =>  $model->deleted_at,
        ]);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}