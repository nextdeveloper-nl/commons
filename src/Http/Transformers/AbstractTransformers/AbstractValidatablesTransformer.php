<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\Validatables;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class ValidatablesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractValidatablesTransformer extends AbstractTransformer
{

    /**
     * @param Validatables $model
     *
     * @return array
     */
    public function transform(Validatables $model)
    {
            
        return $this->buildPayload(
            [
            'id'  =>  $model->uuid,
            'object_id'  =>  $model->object_id,
            'object_type'  =>  $model->object_type,
            'validation_data'  =>  $model->validation_data,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
            'deleted_at'  =>  $model->deleted_at,
            ]
        );
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n


















































}
