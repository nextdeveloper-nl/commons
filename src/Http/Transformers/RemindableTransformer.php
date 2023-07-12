<?php

namespace NextDeveloper\Commons\Http\Transformers;

use NextDeveloper\Commons\Database\Models\Remindable;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class RemindableTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class RemindableTransformer extends AbstractTransformer {

    /**
     * @param Remindable $model
     *
     * @return array
     */
    public function transform(Remindable $model) {
        return $this->buildPayload([
            'id'  =>  $model->uuid,
            'remindable_id'  =>  $model->remindable_id,
            'remindable_object_type'  =>  $model->remindable_object_type,
            'remind_datetime'  =>  $model->remind_datetime,
            'snooze_datetime'  =>  $model->snooze_datetime,
            'user_id'  =>  $model->user_id,
            'note'  =>  $model->note,
            'status'  =>  $model->status,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
            'deleted_at'  =>  $model->deleted_at,
        ]);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}