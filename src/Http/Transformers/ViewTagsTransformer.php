<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\ViewTags;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractViewTagsTransformer;

/**
 * Class ViewTagsTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class ViewTagsTransformer extends AbstractViewTagsTransformer
{

    /**
     * @param ViewTags $model
     *
     * @return array
     */
    public function transform(ViewTags $model)
    {
        $transformed = Cache::get(
            CacheHelper::getKey('ViewTags', $model->uuid, 'Transformed')
        );

        if($transformed) {
            return $transformed;
        }

        $transformed = parent::transform($model);

        unset($transformed['object_type']);
        unset($transformed['object_id']);

        Cache::set(
            CacheHelper::getKey('ViewTags', $model->uuid, 'Transformed'),
            $transformed
        );

        return $transformed;
    }
}
