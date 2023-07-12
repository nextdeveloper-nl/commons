<?php

namespace NextDeveloper\Commons\Http\Transformers;

use NextDeveloper\Commons\Database\Models\Domain;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class DomainTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class DomainTransformer extends AbstractTransformer {

    /**
     * @param Domain $model
     *
     * @return array
     */
    public function transform(Domain $model) {
        return $this->buildPayload([
            'id'  =>  $model->uuid,
            'account_id'  =>  $model->account_id,
            'name'  =>  $model->name,
            'is_active'  =>  $model->is_active,
            'is_local_domain'  =>  $model->is_local_domain,
            'is_locked'  =>  $model->is_locked,
            'is_shared_domain'  =>  $model->is_shared_domain == 1 ? true : false,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
            'deleted_at'  =>  $model->deleted_at,
        ]);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}