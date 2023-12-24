<?php

namespace NextDeveloper\Commons\Http\Transformers;

use Illuminate\Support\Facades\Cache;
use NextDeveloper\Commons\Common\Cache\CacheHelper;
use NextDeveloper\Commons\Database\Models\PhoneNumbers;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformers\AbstractPhoneNumbersTransformer;

/**
 * Class PhoneNumbersTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class PhoneNumbersTransformer extends AbstractPhoneNumbersTransformer
{

    /**
     * @param PhoneNumbers $model
     *
     * @return array
     */
    public function transform(PhoneNumbers $model)
    {
        $transformed = Cache::get(
            CacheHelper::getKey('PhoneNumbers', $model->uuid, 'Transformed')
        );

        if($transformed) {
            return $transformed;
        }

        $transformed = parent::transform($model);

        Cache::set(
            CacheHelper::getKey('PhoneNumbers', $model->uuid, 'Transformed'),
            $transformed
        );

        return $transformed;
    }
}
