<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\Domains;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractDomainsTransformer;

/**
 * Class DomainsTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class DomainsTransformer extends AbstractDomainsTransformer {

    /**
     * @param Domains $model
     *
     * @return array
     */
    public function transform(Domains $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('Domains', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('Domains', $model->uuid, 'Transformed'),
            $transformed
        );

        return $transformed;
    }
}
