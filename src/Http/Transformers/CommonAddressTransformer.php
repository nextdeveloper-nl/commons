<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\CommonAddress;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractCommonAddressTransformer;

/**
 * Class CommonAddressTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonAddressTransformer extends AbstractCommonAddressTransformer {

    /**
     * @param CommonAddress $model
     *
     * @return array
     */
    public function transform(CommonAddress $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('CommonAddress', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('CommonAddress', $model->uuid, 'Transformed'),
            $transformed
        );

        return parent::transform($model);
    }
}
