<?php

namespace NextDeveloper\Commons\Http\Transformers;

use NextDeveloper\Commons\Database\Models\CommonRegistry;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CommonRegistryTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonRegistryTransformer extends AbstractTransformer {

    /**
     * @param CommonRegistry $model
     *
     * @return array
     */
    public function transform(CommonRegistry $model) {
        return $this->buildPayload([
            'id'  =>  $model->id,
            'key'  =>  $model->key,
            'value'  =>  $model->value,
        ]);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}