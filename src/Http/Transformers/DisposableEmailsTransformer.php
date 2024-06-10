<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\DisposableEmails;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractDisposableEmailsTransformer;

/**
 * Class DisposableEmailsTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class DisposableEmailsTransformer extends AbstractDisposableEmailsTransformer {

    /**
     * @param DisposableEmails $model
     *
     * @return array
     */
    public function transform(DisposableEmails $model) {
        $transformed = Cache::get(
            CacheHelper::getKey('DisposableEmails', $model->uuid, 'Transformed')
        );

        if($transformed)
            return $transformed;

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('DisposableEmails', $model->uuid, 'Transformed'),
            $transformed
        );

        return $transformed;
    }
}
