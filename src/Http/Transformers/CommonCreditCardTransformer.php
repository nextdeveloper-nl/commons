<?php

namespace NextDeveloper\Commons\Http\Transformers;

use NextDeveloper\Commons\Database\Models\CommonCreditCard;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CommonCreditCardTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonCreditCardTransformer extends AbstractTransformer {

    /**
     * @param CommonCreditCard $model
     *
     * @return array
     */
    public function transform(CommonCreditCard $model) {
        return $this->buildPayload([
            'id'  =>  $model->uuid,
            'type'  =>  $model->type,
            'cc_holder_name'  =>  $model->cc_holder_name,
            'cc_number'  =>  $model->cc_number,
            'cc_month'  =>  $model->cc_month,
            'cc_year'  =>  $model->cc_year,
            'cc_cvv'  =>  $model->cc_cvv,
            'is_default'  =>  $model->is_default,
            'is_valid'  =>  $model->is_valid,
            'is_active'  =>  $model->is_active,
            'score'  =>  $model->score == 1 ? true : false,
            'is_3d_secure_enabled'  =>  $model->is_3d_secure_enabled == 1 ? true : false,
            'retry_count'  =>  $model->retry_count,
            'account_id'  =>  $model->account_id,
            'user_id'  =>  $model->user_id,
            'last_retry_date'  =>  $model->last_retry_date,
            'verification_date'  =>  $model->verification_date,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
            'deleted_at'  =>  $model->deleted_at,
        ]);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}