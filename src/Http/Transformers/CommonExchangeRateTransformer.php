<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\CommonExchangeRate;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractCommonExchangeRateTransformer;

/**
 * Class CommonExchangeRateTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonExchangeRateTransformer extends AbstractCommonExchangeRateTransformer {

    /**
     * @param CommonExchangeRate $model
     *
     * @return array
     */
    public function transform(CommonExchangeRate $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('CommonExchangeRate', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('CommonExchangeRate', $model->uuid, 'Transformed'),
            $transformed
        );

        return parent::transform($model);
    }
}
