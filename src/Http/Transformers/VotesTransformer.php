<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\Votes;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractVotesTransformer;

/**
 * Class VotesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class VotesTransformer extends AbstractVotesTransformer {

    /**
     * @param Votes $model
     *
     * @return array
     */
    public function transform(Votes $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('Votes', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('Votes', $model->uuid, 'Transformed'),
            $transformed
        );

        return $transformed;
    }
}
