<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\Countries;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CountriesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractCountriesTransformer extends AbstractTransformer
{

    /**
     * @param Countries $model
     *
     * @return array
     */
    public function transform(Countries $model)
    {
                
        return $this->buildPayload(
            [
            'id'  =>  $model->uuid,
            'code'  =>  $model->code,
            'locale'  =>  $model->locale,
            'name'  =>  $model->name,
            'currency_code'  =>  $model->currency_code,
            'phone_code'  =>  $model->phone_code,
            'vat_rate'  =>  $model->vat_rate,
            'continent_name'  =>  $model->continent_name,
            'continent_code'  =>  $model->continent_code,
            'geo_name_identitiy'  =>  $model->geo_name_identitiy,
            'is_active'  =>  $model->is_active,
            'timezones'  =>  $model->timezones,
            ]
        );
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
































}
