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
                        $commonCountryId = \NextDeveloper\Commons\Database\Models\Countries::where('id', $model->common_country_id)->first();
                    $iamAccountId = \NextDeveloper\IAM\Database\Models\Accounts::where('id', $model->iam_account_id)->first();
        
        return $this->buildPayload(
            [
            'id'  =>  $model->uuid,
            'object_id'  =>  $model->object_id,
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
            'iam_account_id'  =>  $iamAccountId ? $iamAccountId->uuid : null,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
            'deleted_at'  =>  $model->deleted_at,
            ]
        );
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n































































}
