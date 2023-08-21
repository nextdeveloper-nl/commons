<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\CommonCountry;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CommonCountryTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractCommonCountryTransformer extends AbstractTransformer {

    /**
     * @param CommonCountry $model
     *
     * @return array
     */
    public function transform(CommonCountry $model) {
                        $geoNameId = \NextDeveloper\\Database\Models\GeoName::where('id', $model->geo_name_id)->first();
            
        return $this->buildPayload([
'id'  =>  $model->uuid,
'code'  =>  $model->code,
'locale'  =>  $model->locale,
'name'  =>  $model->name,
'currency_code'  =>  $model->currency_code,
'phone_code'  =>  $model->phone_code,
'vat_rate'  =>  $model->vat_rate,
'continent_name'  =>  $model->continent_name,
'continent_code'  =>  $model->continent_code,
'geo_name_id'  =>  $geoNameId ? $geoNameId->uuid : null,
'is_active'  =>  $model->is_active,
'timezones'  =>  $model->timezones,
    ]);
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}
