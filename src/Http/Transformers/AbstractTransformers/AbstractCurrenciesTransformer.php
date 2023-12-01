<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\Currencies;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CurrenciesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractCurrenciesTransformer extends AbstractTransformer
{

    /**
     * @param Currencies $model
     *
     * @return array
     */
    public function transform(Currencies $model)
    {
                        $commonCountryId = \NextDeveloper\Commons\Database\Models\Countries::where('id', $model->common_country_id)->first();
            
        return $this->buildPayload(
            [
            'id'  =>  $model->uuid,
            'code'  =>  $model->code,
            'name'  =>  $model->name,
            'common_country_id'  =>  $commonCountryId ? $commonCountryId->uuid : null,
            ]
        );
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n


























}
