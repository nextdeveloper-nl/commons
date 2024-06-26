<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\Categories;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractCategoriesTransformer;

/**
 * Class CategoriesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CategoriesTransformer extends AbstractCategoriesTransformer {

    /**
     * @param Categories $model
     *
     * @return array
     */
    public function transform(Categories $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('Categories', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('Categories', $model->uuid, 'Transformed'),
            $transformed
        );

        return $transformed;
    }
}
