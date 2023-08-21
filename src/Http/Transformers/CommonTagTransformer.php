<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\CommonTag;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractCommonTagTransformer;

/**
 * Class CommonTagTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonTagTransformer extends AbstractCommonTagTransformer {

    /**
     * @param CommonTag $model
     *
     * @return array
     */
    public function transform(CommonTag $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('CommonTag', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('CommonTag', $model->uuid, 'Transformed'),
            $transformed
        );

        return parent::transform($model);
    }
}
