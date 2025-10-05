<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\ScheduledTasks;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractScheduledTasksTransformer;

/**
 * Class ScheduledTasksTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class ScheduledTasksTransformer extends AbstractScheduledTasksTransformer
{

    /**
     * @param ScheduledTasks $model
     *
     * @return array
     */
    public function transform(ScheduledTasks $model)
    {
        $transformed = Cache::get(
            CacheHelper::getKey('ScheduledTasks', $model->uuid, 'Transformed')
        );

        if($transformed) {
            return $transformed;
        }

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('ScheduledTasks', $model->uuid, 'Transformed'),
            $transformed
        );

        return $transformed;
    }
}
