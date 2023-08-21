<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\CommonDomainable;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractCommonDomainableTransformer;

/**
 * Class CommonDomainableTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonDomainableTransformer extends AbstractCommonDomainableTransformer {

    /**
     * @param CommonDomainable $model
     *
     * @return array
     */
    public function transform(CommonDomainable $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('CommonDomainable', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('CommonDomainable', $model->uuid, 'Transformed'),
            $transformed
        );

        return parent::transform($model);
    }
}
