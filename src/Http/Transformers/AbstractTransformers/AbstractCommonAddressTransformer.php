<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\CommonAddress;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CommonAddressTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractCommonAddressTransformer extends AbstractTransformer {

    /**
     * @param CommonAddress $model
     *
     * @return array
     */
    public function transform(CommonAddress $model) {
                        $addressableId = \NextDeveloper\\Database\Models\Addressable::where('id', $model->addressable_id)->first();
                    $countryId = \NextDeveloper\\Database\Models\Country::where('id', $model->country_id)->first();
            
        return $this->buildPayload([
'id'  =>  $model->uuid,
'addressable_id'  =>  $addressableId ? $addressableId->uuid : null,
'addressable_type'  =>  $model->addressable_type,
'name'  =>  $model->name,
'line1'  =>  $model->line1,
'line2'  =>  $model->line2,
'city'  =>  $model->city,
'state'  =>  $model->state,
'state_code'  =>  $model->state_code,
'postcode'  =>  $model->postcode,
'is_invoice_address'  =>  $model->is_invoice_address,
'country_id'  =>  $countryId ? $countryId->uuid : null,
'email_address'  =>  $model->email_address,
'created_at'  =>  $model->created_at,
'updated_at'  =>  $model->updated_at,
'deleted_at'  =>  $model->deleted_at,
    ]);
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n










}
