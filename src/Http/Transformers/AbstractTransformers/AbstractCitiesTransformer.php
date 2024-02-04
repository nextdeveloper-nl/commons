<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\Cities;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CitiesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractCitiesTransformer extends AbstractTransformer
{

    /**
     * @param Cities $model
     *
     * @return array
     */
    public function transform(Cities $model)
    {
                        $commonCountryId = \NextDeveloper\Commons\Database\Models\Countries::where('id', $model->common_country_id)->first();
        
        return $this->buildPayload(
            [
            'id'  =>  $model->uuid,
            'code'  =>  $model->code,
            'locale'  =>  $model->locale,
            'name'  =>  $model->name,
            'phone_code'  =>  $model->phone_code,
            'geo_name_identitiy'  =>  $model->geo_name_identitiy,
            'is_active'  =>  $model->is_active,
            'timezones'  =>  $model->timezones,
            'common_country_id'  =>  $commonCountryId ? $commonCountryId->uuid : null,
            ]
        );
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE



}
