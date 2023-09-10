<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\States;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractStatesTransformer;

/**
 * Class StatesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class StatesTransformer extends AbstractStatesTransformer {

    /**
     * @param States $model
     *
     * @return array
     */
    public function transform(States $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('States', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('States', $model->uuid, 'Transformed'),
            $transformed
        );

        return parent::transform($model);
    }
}
