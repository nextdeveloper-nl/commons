<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\Countries;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractCountriesTransformer;

/**
 * Class CountriesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CountriesTransformer extends AbstractCountriesTransformer {

    /**
     * @param Countries $model
     *
     * @return array
     */
    public function transform(Countries $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('Countries', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('Countries', $model->uuid, 'Transformed'),
            $transformed
        );

        return parent::transform($model);
    }
}
