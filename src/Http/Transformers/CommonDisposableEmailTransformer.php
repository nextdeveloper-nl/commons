<?php

namespace NextDeveloper\Commons\Http\Transformers;

use NextDeveloper\Commons\Database\Models\CommonDisposableEmail;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CommonDisposableEmailTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonDisposableEmailTransformer extends AbstractTransformer {

    /**
     * @param CommonDisposableEmail $model
     *
     * @return array
     */
    public function transform(CommonDisposableEmail $model) {
        return $this->buildPayload([
            'id'  =>  $model->uuid,
            'domain_id'  =>  $model->domain_id,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
            'deleted_at'  =>  $model->deleted_at,
        ]);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}