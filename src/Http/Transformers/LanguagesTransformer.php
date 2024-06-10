<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\Languages;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractLanguagesTransformer;

/**
 * Class LanguagesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class LanguagesTransformer extends AbstractLanguagesTransformer {

    /**
     * @param Languages $model
     *
     * @return array
     */
    public function transform(Languages $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('Languages', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('Languages', $model->uuid, 'Transformed'),
            $transformed
        );

        return $transformed;
    }
}
