<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\CommonRegistry;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractCommonRegistryTransformer;

/**
 * Class CommonRegistryTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonRegistryTransformer extends AbstractCommonRegistryTransformer {

    /**
     * @param CommonRegistry $model
     *
     * @return array
     */
    public function transform(CommonRegistry $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('CommonRegistry', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('CommonRegistry', $model->uuid, 'Transformed'),
            $transformed
        );

        return parent::transform($model);
    }
}
