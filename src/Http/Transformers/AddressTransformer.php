<?php

namespace NextDeveloper\Commons\Http\Transformers;

use NextDeveloper\Commons\Database\Models\Address;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class AddressTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AddressTransformer extends AbstractTransformer {

    /**
     * @param Address $model
     *
     * @return array
     */
    public function transform(Address $model) {
        return $this->buildPayload([
            'id'  =>  $model->uuid,
            'addressable_id'  =>  $model->addressable_id,
            'addressable_type'  =>  $model->addressable_type,
            'name'  =>  $model->name,
            'line1'  =>  $model->line1,
            'line2'  =>  $model->line2,
            'city'  =>  $model->city,
            'state'  =>  $model->state,
            'state_code'  =>  $model->state_code,
            'postcode'  =>  $model->postcode,
            'is_invoice_address'  =>  $model->is_invoice_address,
            'country_id'  =>  $model->country_id,
            'email_address'  =>  $model->email_address,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
            'deleted_at'  =>  $model->deleted_at,
        ]);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}