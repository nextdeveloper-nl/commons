<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\Meta;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractMetaTransformer;

/**
 * Class MetaTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class MetaTransformer extends AbstractMetaTransformer {

    /**
     * @param Meta $model
     *
     * @return array
     */
    public function transform(Meta $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('Meta', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('Meta', $model->uuid, 'Transformed'),
            $transformed
        );

        return parent::transform($model);
    }
}
