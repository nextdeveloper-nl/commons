<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\CommonVote;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractCommonVoteTransformer;

/**
 * Class CommonVoteTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonVoteTransformer extends AbstractCommonVoteTransformer {

    /**
     * @param CommonVote $model
     *
     * @return array
     */
    public function transform(CommonVote $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('CommonVote', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('CommonVote', $model->uuid, 'Transformed'),
            $transformed
        );

        return parent::transform($model);
    }
}
