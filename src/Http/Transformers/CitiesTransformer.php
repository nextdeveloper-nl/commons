<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\Cities;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractCitiesTransformer;

/**
 * Class CitiesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CitiesTransformer extends AbstractCitiesTransformer
{

    /**
     * @param Cities $model
     *
     * @return array
     */
    public function transform(Cities $model)
    {
        $transformed = Cache::get(
            CacheHelper::getKey('Cities', $model->uuid, 'Transformed')
        );

        if($transformed) {
            return $transformed;
        }

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('Cities', $model->uuid, 'Transformed'),
            $transformed
        );

        return $transformed;
    }
}
