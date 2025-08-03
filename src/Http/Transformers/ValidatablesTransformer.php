<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\Validatables;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractValidatablesTransformer;

/**
 * Class ValidatablesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class ValidatablesTransformer extends AbstractValidatablesTransformer {

    /**
     * @param Validatables $model
     *
     * @return array
     */
    public function transform(Validatables $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('Validatables', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('Validatables', $model->uuid, 'Transformed'),
            $transformed
        );

        return $transformed;
    }
}
