<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\ExchangeRates;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractExchangeRatesTransformer;

/**
 * Class ExchangeRatesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class ExchangeRatesTransformer extends AbstractExchangeRatesTransformer {

    /**
     * @param ExchangeRates $model
     *
     * @return array
     */
    public function transform(ExchangeRates $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('ExchangeRates', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('ExchangeRates', $model->uuid, 'Transformed'),
            $transformed
        );

        return $transformed;
    }
}
