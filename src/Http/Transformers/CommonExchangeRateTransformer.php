<?php

namespace NextDeveloper\Commons\Http\Transformers;

use NextDeveloper\Commons\Database\Models\CommonExchangeRate;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CommonExchangeRateTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonExchangeRateTransformer extends AbstractTransformer {

    /**
     * @param CommonExchangeRate $model
     *
     * @return array
     */
    public function transform(CommonExchangeRate $model) {
        return $this->buildPayload([
            'id'  =>  $model->uuid,
            'country_id'  =>  $model->country_id,
            'code'  =>  $model->code,
            'rate'  =>  $model->rate,
            'last_modified'  =>  $model->last_modified,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
        ]);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}