<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\ProfileTags;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractProfileTagsTransformer;

/**
 * Class ProfileTagsTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class ProfileTagsTransformer extends AbstractProfileTagsTransformer
{

    /**
     * @param ProfileTags $model
     *
     * @return array
     */
    public function transform(ProfileTags $model)
    {
        $transformed = Cache::get(
            CacheHelper::getKey('ProfileTags', $model->uuid, 'Transformed')
        );

        if($transformed) {
            return $transformed;
        }

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('ProfileTags', $model->uuid, 'Transformed'),
            $transformed
        );

        return $transformed;
    }
}
