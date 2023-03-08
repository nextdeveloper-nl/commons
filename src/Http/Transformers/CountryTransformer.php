<?php

namespace NextDeveloper\Commons\Http\Transformers;

use NextDeveloper\Commons\Database\Models\Country;

/**
 * Class CountryTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CountryTransformer extends AbstractTransformer {

    /**
     * @param Country $model
     *
     * @return array
     */
    public function transform(Country $model) {
        return $this->buildPayload([
            'id'  =>  $model->id_ref,
            'code'  =>  $model->code,
            'locale'  =>  $model->locale,
            'name'  =>  $model->name,
            'currency_code'  =>  $model->currency_code,
            'phone_code'  =>  $model->phone_code,
            'rate'  =>  $model->rate,
            'percentage'  =>  $model->percentage,
            'continent_name'  =>  $model->continent_name,
            'continent_code'  =>  $model->continent_code,
            'geo_name_code'  =>  $model->geo_name_code,
            'is_active'  =>  $model->is_active,
        ]);
    }
}
