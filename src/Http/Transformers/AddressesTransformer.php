<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\Addresses;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractAddressesTransformer;

/**
 * Class AddressesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AddressesTransformer extends AbstractAddressesTransformer {

    /**
     * @param Addresses $model
     *
     * @return array
     */
    public function transform(Addresses $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('Addresses', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        unset($transformed['object_id']);
        unset($transformed['object_type']);

        Cache::set(
            CacheHelper::getKey('Addresses', $model->uuid, 'Transformed'),
            $transformed
        );

        return $transformed;
    }
}
