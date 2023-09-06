<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\CommonValidatable;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractCommonValidatableTransformer;

/**
 * Class CommonValidatableTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonValidatableTransformer extends AbstractCommonValidatableTransformer {

    /**
     * @param CommonValidatable $model
     *
     * @return array
     */
    public function transform(CommonValidatable $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('CommonValidatable', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('CommonValidatable', $model->uuid, 'Transformed'),
            $transformed
        );

        return parent::transform($model);
    }
}
