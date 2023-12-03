<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\Registries;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class RegistriesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractRegistriesTransformer extends AbstractTransformer
{

    /**
     * @param Registries $model
     *
     * @return array
     */
    public function transform(Registries $model)
    {
            
        return $this->buildPayload(
            [
            'id'  =>  $model->id,
            'key'  =>  $model->key,
            'value'  =>  $model->value,
            ]
        );
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n









































}
