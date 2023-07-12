<?php

namespace NextDeveloper\Commons\Http\Transformers;

use NextDeveloper\Commons\Database\Models\Notification;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class NotificationTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class NotificationTransformer extends AbstractTransformer {

    /**
     * @param Notification $model
     *
     * @return array
     */
    public function transform(Notification $model) {
        return $this->buildPayload([
            'id'  =>  $model->uuid,
            'type'  =>  $model->type,
            'notifiable_id'  =>  $model->notifiable_id,
            'notifiable_type'  =>  $model->notifiable_type,
            'data'  =>  $model->data,
            'read_at'  =>  $model->read_at,
            'user_id'  =>  $model->user_id,
            'account_id'  =>  $model->account_id,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
            'deleted_at'  =>  $model->deleted_at,
        ]);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}