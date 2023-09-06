<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\CommonExchangeRate;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CommonExchangeRateTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractCommonExchangeRateTransformer extends AbstractTransformer {

    /**
     * @param CommonExchangeRate $model
     *
     * @return array
     */
    public function transform(CommonExchangeRate $model) {
                        $commonCountryId = \NextDeveloper\Commons\Database\Models\CommonCountry::where('id', $model->common_country_id)->first();
            
        return $this->buildPayload([
'id'  =>  $model->uuid,
'common_country_id'  =>  $commonCountryId ? $commonCountryId->uuid : null,
'code'  =>  $model->code,
'rate'  =>  $model->rate,
'last_modified'  =>  $model->last_modified,
'created_at'  =>  $model->created_at,
'updated_at'  =>  $model->updated_at,
    ]);
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n









}
