<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\CommonMedia;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractCommonMediaTransformer;

/**
 * Class CommonMediaTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonMediaTransformer extends AbstractCommonMediaTransformer {

    /**
     * @param CommonMedia $model
     *
     * @return array
     */
    public function transform(CommonMedia $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('CommonMedia', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('CommonMedia', $model->uuid, 'Transformed'),
            $transformed
        );

        return parent::transform($model);
    }
}
