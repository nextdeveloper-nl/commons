<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\TaskSchedulers;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractTaskSchedulersTransformer;

/**
 * Class TaskSchedulersTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class TaskSchedulersTransformer extends AbstractTaskSchedulersTransformer
{

    /**
     * @param TaskSchedulers $model
     *
     * @return array
     */
    public function transform(TaskSchedulers $model)
    {
        $transformed = Cache::get(
            CacheHelper::getKey('TaskSchedulers', $model->uuid, 'Transformed')
        );

        if($transformed) {
            return $transformed;
        }

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('TaskSchedulers', $model->uuid, 'Transformed'),
            $transformed
        );

        return $transformed;
    }
}
