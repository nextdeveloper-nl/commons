<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\AvailableActions;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractAvailableActionsTransformer;

/**
 * Class AvailableActionsTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AvailableActionsTransformer extends AbstractAvailableActionsTransformer
{

    /**
     * @param AvailableActions $model
     *
     * @return array
     */
    public function transform(AvailableActions $model)
    {
        $transformed = Cache::get(
            CacheHelper::getKey('AvailableActions', $model->uuid, 'Transformed')
        );

        if($transformed) {
            return $transformed;
        }

        $transformed = parent::transform($model);

        unset($transformed['class']);

        $transformed['action-name'] = Str::kebab($transformed['action']);

        Cache::set(
            CacheHelper::getKey('AvailableActions', $model->uuid, 'Transformed'),
            $transformed
        );

        return $transformed;
    }
}
