<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\CommonSocialMedia;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CommonSocialMediaTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractCommonSocialMediaTransformer extends AbstractTransformer {

    /**
     * @param CommonSocialMedia $model
     *
     * @return array
     */
    public function transform(CommonSocialMedia $model) {
                        $sociableId = \NextDeveloper\\Database\Models\Sociable::where('id', $model->sociable_id)->first();
            
        return $this->buildPayload([
'id'  =>  $model->uuid,
'sociable_id'  =>  $sociableId ? $sociableId->uuid : null,
'sociable_type'  =>  $model->sociable_type,
'profile_url'  =>  $model->profile_url,
'is_invoice_address'  =>  $model->is_invoice_address,
'created_at'  =>  $model->created_at,
'updated_at'  =>  $model->updated_at,
'deleted_at'  =>  $model->deleted_at,
    ]);
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}
