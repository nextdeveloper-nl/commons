<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\CommonLanguage;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractCommonLanguageTransformer;

/**
 * Class CommonLanguageTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonLanguageTransformer extends AbstractCommonLanguageTransformer {

    /**
     * @param CommonLanguage $model
     *
     * @return array
     */
    public function transform(CommonLanguage $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('CommonLanguage', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('CommonLanguage', $model->uuid, 'Transformed'),
            $transformed
        );

        return parent::transform($model);
    }
}
