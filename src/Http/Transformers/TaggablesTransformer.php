<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\Taggables;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractTaggablesTransformer;

/**
 * Class TaggablesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class TaggablesTransformer extends AbstractTaggablesTransformer {

    /**
     * @param Taggables $model
     *
     * @return array
     */
    public function transform(Taggables $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('Taggables', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('Taggables', $model->uuid, 'Transformed'),
            $transformed
        );

        return parent::transform($model);
    }
}
