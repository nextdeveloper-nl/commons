<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\CommonCategory;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractCommonCategoryTransformer;

/**
 * Class CommonCategoryTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonCategoryTransformer extends AbstractCommonCategoryTransformer {

    /**
     * @param CommonCategory $model
     *
     * @return array
     */
    public function transform(CommonCategory $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('CommonCategory', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('CommonCategory', $model->uuid, 'Transformed'),
            $transformed
        );

        return parent::transform($model);
    }
}
