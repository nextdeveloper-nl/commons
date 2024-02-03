<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\CountryStates;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CountryStatesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractCountryStatesTransformer extends AbstractTransformer
{

    /**
     * @param CountryStates $model
     *
     * @return array
     */
    public function transform(CountryStates $model)
    {
                        $commonCountryId = \NextDeveloper\Commons\Database\Models\Countries::where('id', $model->common_country_id)->first();
        
        return $this->buildPayload(
            [
            'id'  =>  $model->uuid,
            'name'  =>  $model->name,
            'code'  =>  $model->code,
            'latitude'  =>  $model->latitude,
            'longitude'  =>  $model->longitude,
            'type'  =>  $model->type,
            'common_country_id'  =>  $commonCountryId ? $commonCountryId->uuid : null,
            'is_active'  =>  $model->is_active,
            'timezones'  =>  $model->timezones,
            ]
        );
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
