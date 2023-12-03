<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\Tags;
use NextDeveloper\Commons\Helpers\TagHelper;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractTagsTransformer;

/**
 * Class TagsTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class TagsTransformer extends AbstractTagsTransformer {

    /**
     * @param Tags $model
     *
     * @return array
     */
    public function transform(Tags $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('Tags', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('Tags', $model->uuid, 'Transformed'),
            $transformed
        );

        return parent::transform($model);
    }
}
