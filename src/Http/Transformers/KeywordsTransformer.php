<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\Keywords;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractKeywordsTransformer;

/**
 * Class KeywordsTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class KeywordsTransformer extends AbstractKeywordsTransformer
{

    /**
     * @param Keywords $model
     *
     * @return array
     */
    public function transform(Keywords $model)
    {
        $transformed = Cache::get(
            CacheHelper::getKey('Keywords', $model->uuid, 'Transformed')
        );

        if($transformed) {
            return $transformed;
        }

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('Keywords', $model->uuid, 'Transformed'),
            $transformed
        );

        return $transformed;
    }
}
