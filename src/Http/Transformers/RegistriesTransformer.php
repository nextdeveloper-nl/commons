<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\Registries;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractRegistriesTransformer;

/**
 * Class RegistriesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class RegistriesTransformer extends AbstractRegistriesTransformer {

    /**
     * @param Registries $model
     *
     * @return array
     */
    public function transform(Registries $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('Registries', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('Registries', $model->uuid, 'Transformed'),
            $transformed
        );

        return parent::transform($model);
    }
}
