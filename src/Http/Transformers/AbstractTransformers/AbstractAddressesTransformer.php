<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\Addresses;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class AddressesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractAddressesTransformer extends AbstractTransformer
{

    /**
     * @param Addresses $model
     *
     * @return array
     */
    public function transform(Addresses $model)
    {
                        $objectId = \NextDeveloper\\Database\Models\Objects::where('id', $model->object_id)->first();
                    $commonCountryId = \NextDeveloper\Commons\Database\Models\Countries::where('id', $model->common_country_id)->first();
            
        return $this->buildPayload(
            [
            'id'  =>  $model->uuid,
            'object_id'  =>  $objectId ? $objectId->uuid : null,
            'object_type'  =>  $model->object_type,
            'name'  =>  $model->name,
            'line1'  =>  $model->line1,
            'line2'  =>  $model->line2,
            'city'  =>  $model->city,
            'state'  =>  $model->state,
            'state_code'  =>  $model->state_code,
            'postcode'  =>  $model->postcode,
            'is_invoice_address'  =>  $model->is_invoice_address,
            'common_country_id'  =>  $commonCountryId ? $commonCountryId->uuid : null,
            'email_address'  =>  $model->email_address,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
            'deleted_at'  =>  $model->deleted_at,
            ]
        );
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n


















}
