<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\CommonCountry;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractCommonCountryTransformer;

/**
 * Class CommonCountryTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonCountryTransformer extends AbstractCommonCountryTransformer {

    /**
     * @param CommonCountry $model
     *
     * @return array
     */
    public function transform(CommonCountry $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('CommonCountry', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('CommonCountry', $model->uuid, 'Transformed'),
            $transformed
        );

        return parent::transform($model);
    }
}
