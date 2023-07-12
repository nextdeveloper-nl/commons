<?php

namespace NextDeveloper\Commons\Http\Transformers;

use NextDeveloper\Commons\Database\Models\Registry;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class RegistryTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class RegistryTransformer extends AbstractTransformer {

    /**
     * @param Registry $model
     *
     * @return array
     */
    public function transform(Registry $model) {
        return $this->buildPayload([
            'id'  =>  $model->id,
            'key'  =>  $model->key,
            'value'  =>  $model->value,
        ]);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}