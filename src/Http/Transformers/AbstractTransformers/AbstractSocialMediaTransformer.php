<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\SocialMedia;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class SocialMediaTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractSocialMediaTransformer extends AbstractTransformer
{

    /**
     * @param SocialMedia $model
     *
     * @return array
     */
    public function transform(SocialMedia $model)
    {
                        $objectId = \NextDeveloper\\Database\Models\Objects::where('id', $model->object_id)->first();
            
        return $this->buildPayload(
            [
            'id'  =>  $model->uuid,
            'object_id'  =>  $objectId ? $objectId->uuid : null,
            'object_type'  =>  $model->object_type,
            'profile_url'  =>  $model->profile_url,
            'is_invoice_address'  =>  $model->is_invoice_address,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
            'deleted_at'  =>  $model->deleted_at,
            ]
        );
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n


















}
