<?php

namespace NextDeveloper\Commons\Http\Transformers;

use NextDeveloper\Commons\Database\Models\Vote;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class VoteTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class VoteTransformer extends AbstractTransformer {

    /**
     * @param Vote $model
     *
     * @return array
     */
    public function transform(Vote $model) {
        return $this->buildPayload([
            'id'  =>  $model->uuid,
            'value'  =>  $model->value == 1 ? true : false,
            'voteable_id'  =>  $model->voteable_id,
            'voteable_type'  =>  $model->voteable_type,
            'user_id'  =>  $model->user_id,
            'account_id'  =>  $model->account_id,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
            'deleted_at'  =>  $model->deleted_at,
        ]);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}