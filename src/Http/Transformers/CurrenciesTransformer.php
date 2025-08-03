<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\Currencies;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractCurrenciesTransformer;

/**
 * Class CurrenciesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CurrenciesTransformer extends AbstractCurrenciesTransformer
{

    /**
     * @param Currencies $model
     *
     * @return array
     */
    public function transform(Currencies $model)
    {
        $transformed = Cache::get(
            CacheHelper::getKey('Currencies', $model->uuid, 'Transformed')
        );

        if($transformed) {
            return $transformed;
        }

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('Currencies', $model->uuid, 'Transformed'),
            $transformed
        );

        return $transformed;
    }
}
