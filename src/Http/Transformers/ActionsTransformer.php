<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\Actions;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractActionsTransformer;

/**
 * Class ActionsTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class ActionsTransformer extends AbstractActionsTransformer
{

    /**
     * @param Actions $model
     *
     * @return array
     */
    public function transform(Actions $model)
    {
//        $transformed = Cache::get(
//            CacheHelper::getKey('Actions', $model->uuid, 'Transformed')
//        );
//
//        if($transformed) {
//            //return $transformed;
//        }

        $transformed = parent::transform($model);

//        Cache::set(
//            CacheHelper::getKey('Actions', $model->uuid, 'Transformed'),
//            $transformed
//        );

        return $transformed;
    }
}
