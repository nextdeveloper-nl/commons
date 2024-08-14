<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\SocialMedia;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractSocialMediaTransformer;

/**
 * Class SocialMediaTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class SocialMediaTransformer extends AbstractSocialMediaTransformer {

    /**
     * @param SocialMedia $model
     *
     * @return array
     */
    public function transform(SocialMedia $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('SocialMedia', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('SocialMedia', $model->uuid, 'Transformed'),
            $transformed
        );

        return $transformed;
    }
}
