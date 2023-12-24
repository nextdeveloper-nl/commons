<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\PhoneNumbers;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class PhoneNumbersTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractPhoneNumbersTransformer extends AbstractTransformer
{

    /**
     * @param PhoneNumbers $model
     *
     * @return array
     */
    public function transform(PhoneNumbers $model)
    {
                        $commonCountryId = \NextDeveloper\Commons\Database\Models\Countries::where('id', $model->common_country_id)->first();
        
        return $this->buildPayload(
            [
            'id'  =>  $model->uuid,
            'object_id'  =>  $model->object_id,
            'object_type'  =>  $model->object_type,
            'name'  =>  $model->name,
            'code'  =>  $model->code,
            'number'  =>  $model->number,
            'is_active'  =>  $model->is_active,
            'common_country_id'  =>  $commonCountryId ? $commonCountryId->uuid : null,
            'created_at'  =>  $model->created_at ? $model->created_at->toIso8601String() : null,
            'updated_at'  =>  $model->updated_at ? $model->updated_at->toIso8601String() : null,
            'deleted_at'  =>  $model->deleted_at ? $model->deleted_at->toIso8601String() : null,
            ]
        );
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}
