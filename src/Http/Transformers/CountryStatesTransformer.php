<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\CountryStates;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractCountryStatesTransformer;

/**
 * Class CountryStatesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CountryStatesTransformer extends AbstractCountryStatesTransformer
{

    /**
     * @param CountryStates $model
     *
     * @return array
     */
    public function transform(CountryStates $model)
    {
        $transformed = Cache::get(
            CacheHelper::getKey('CountryStates', $model->uuid, 'Transformed')
        );

        if($transformed) {
            return $transformed;
        }

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('CountryStates', $model->uuid, 'Transformed'),
            $transformed
        );

        return $transformed;
    }
}
