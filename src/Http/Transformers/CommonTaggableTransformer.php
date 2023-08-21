<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\CommonTaggable;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractCommonTaggableTransformer;

/**
 * Class CommonTaggableTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonTaggableTransformer extends AbstractCommonTaggableTransformer {

    /**
     * @param CommonTaggable $model
     *
     * @return array
     */
    public function transform(CommonTaggable $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('CommonTaggable', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('CommonTaggable', $model->uuid, 'Transformed'),
            $transformed
        );

        return parent::transform($model);
    }
}
