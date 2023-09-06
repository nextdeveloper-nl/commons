<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\CommonSocialMedia;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractCommonSocialMediaTransformer;

/**
 * Class CommonSocialMediaTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonSocialMediaTransformer extends AbstractCommonSocialMediaTransformer {

    /**
     * @param CommonSocialMedia $model
     *
     * @return array
     */
    public function transform(CommonSocialMedia $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('CommonSocialMedia', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('CommonSocialMedia', $model->uuid, 'Transformed'),
            $transformed
        );

        return parent::transform($model);
    }
}
