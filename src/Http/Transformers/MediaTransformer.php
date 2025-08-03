<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\Media;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractMediaTransformer;

/**
 * Class MediaTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class MediaTransformer extends AbstractMediaTransformer {

    /**
     * @param Media $model
     *
     * @return array
     */
    public function transform(Media $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('Media', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('Media', $model->uuid, 'Transformed'),
            $transformed
        );

        unset($transformed['object_id']);
        unset($transformed['object_type']);

        return $transformed;
    }
}
