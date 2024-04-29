<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\ActionsPerspective;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractActionsPerspectiveTransformer;

/**
 * Class ActionsPerspectiveTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class ActionsPerspectiveTransformer extends AbstractActionsPerspectiveTransformer
{

    /**
     * @param ActionsPerspective $model
     *
     * @return array
     */
    public function transform(ActionsPerspective $model)
    {
        $transformed = Cache::get(
            CacheHelper::getKey('ActionsPerspective', $model->uuid, 'Transformed')
        );

        if($transformed) {
            return $transformed;
        }

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('ActionsPerspective', $model->uuid, 'Transformed'),
            $transformed
        );

        return $transformed;
    }
}
