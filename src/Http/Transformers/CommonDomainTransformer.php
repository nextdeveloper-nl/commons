<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\CommonDomain;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractCommonDomainTransformer;

/**
 * Class CommonDomainTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonDomainTransformer extends AbstractCommonDomainTransformer {

    /**
     * @param CommonDomain $model
     *
     * @return array
     */
    public function transform(CommonDomain $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('CommonDomain', $model->uuid, 'Transformed')
        );

        if($transformed)
            Log::info('[CommonDomainTransformer] Cache hit');
        else
            Log::info('[CommonDomainTransformer] Cache miss');

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('CommonDomain', $model->uuid, 'Transformed'),
            $transformed
        );

        return parent::transform($model);
    }
}
