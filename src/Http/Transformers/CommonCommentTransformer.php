<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\CommonComment;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractCommonCommentTransformer;

/**
 * Class CommonCommentTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonCommentTransformer extends AbstractCommonCommentTransformer {

    /**
     * @param CommonComment $model
     *
     * @return array
     */
    public function transform(CommonComment $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('CommonComment', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('CommonComment', $model->uuid, 'Transformed'),
            $transformed
        );

        return parent::transform($model);
    }
}
