<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\CommonState;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractCommonStateTransformer;

/**
 * Class CommonStateTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonStateTransformer extends AbstractCommonStateTransformer {

    /**
     * @param CommonState $model
     *
     * @return array
     */
    public function transform(CommonState $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('CommonState', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('CommonState', $model->uuid, 'Transformed'),
            $transformed
        );

        return parent::transform($model);
    }
}
