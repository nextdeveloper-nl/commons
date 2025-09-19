<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\Comments;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractCommentsTransformer;

/**
 * Class CommentsTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommentsTransformer extends AbstractCommentsTransformer {

    /**
     * @param Comments $model
     *
     * @return array
     */
    public function transform(Comments $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('Comments', $model->uuid, 'Transformed')
        );

//        if($transformed)
//            return $transformed;

        $transformed = parent::transform($model);

        $objectType = $transformed['object_type'];
        $objectType = explode('\\', $objectType);

        $transformed['object_id'] = $transformed['object_uuid'];
        $transformed['object_type'] = $objectType[0] . '\\' . $objectType[1] . '\\' . $objectType[4];

        unset($transformed['object_uuid']);

        Cache::set(
            CacheHelper::getKey('Comments', $model->uuid, 'Transformed'),
            $transformed
        );

        return $transformed;
    }
}
