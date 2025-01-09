<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\ExternalServices;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractExternalServicesTransformer;

/**
 * Class ExternalServicesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class ExternalServicesTransformer extends AbstractExternalServicesTransformer
{

    /**
     * @param ExternalServices $model
     *
     * @return array
     */
    public function transform(ExternalServices $model)
    {
        $transformed = Cache::get(
            CacheHelper::getKey('ExternalServices', $model->uuid, 'Transformed')
        );

        if($transformed) {
            return $transformed;
        }

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('ExternalServices', $model->uuid, 'Transformed'),
            $transformed
        );

        return $transformed;
    }
}
