<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\CommonDisposableEmail;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractCommonDisposableEmailTransformer;

/**
 * Class CommonDisposableEmailTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonDisposableEmailTransformer extends AbstractCommonDisposableEmailTransformer {

    /**
     * @param CommonDisposableEmail $model
     *
     * @return array
     */
    public function transform(CommonDisposableEmail $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('CommonDisposableEmail', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('CommonDisposableEmail', $model->uuid, 'Transformed'),
            $transformed
        );

        return parent::transform($model);
    }
}
