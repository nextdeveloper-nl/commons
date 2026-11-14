<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\Pushers;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Pushers\PusherFactory;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractPushersTransformer;

/**
 * Class PushersTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class PushersTransformer extends AbstractPushersTransformer
{

    /**
     * @param Pushers $model
     *
     * @return array
     */
    public function transform(Pushers $model)
    {
        $transformed = Cache::get(
            CacheHelper::getKey('Pushers', $model->uuid, 'Transformed')
        );

        if($transformed) {
            return $transformed;
        }

        $transformed = parent::transform($model);

        // Convenience flag for the UI; status is the single source of truth.
        $transformed['is_active'] = $model->status !== 'disabled';

        // Model classes this pusher's driver works with; empty list = generic (any object).
        $transformed['supported_objects'] = PusherFactory::supportedObjects($model->provider);

        Cache::set(
            CacheHelper::getKey('Pushers', $model->uuid, 'Transformed'),
            $transformed
        );

        return $transformed;
    }
}
