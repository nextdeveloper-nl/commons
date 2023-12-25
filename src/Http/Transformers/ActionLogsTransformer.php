<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\ActionLogs;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractActionLogsTransformer;

/**
 * Class ActionLogsTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class ActionLogsTransformer extends AbstractActionLogsTransformer
{

    /**
     * @param ActionLogs $model
     *
     * @return array
     */
    public function transform(ActionLogs $model)
    {
        $transformed = Cache::get(
            CacheHelper::getKey('ActionLogs', $model->uuid, 'Transformed')
        );

        if($transformed) {
            return $transformed;
        }

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('ActionLogs', $model->uuid, 'Transformed'),
            $transformed
        );

        return $transformed;
    }
}
