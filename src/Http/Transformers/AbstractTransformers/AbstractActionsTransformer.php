<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\Actions;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class ActionsTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractActionsTransformer extends AbstractTransformer
{

    /**
     * @param Actions $model
     *
     * @return array
     */
    public function transform(Actions $model)
    {
            
        return $this->buildPayload(
            [
            'id'  =>  $model->uuid,
            'action'  =>  $model->action,
            'progress'  =>  $model->progress,
            'runtime'  =>  $model->runtime,
            'object_id'  =>  $model->object_id,
            'object_type'  =>  $model->object_type,
            'created_at'  =>  $model->created_at ? $model->created_at->toIso8601String() : null,
            ]
        );
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

}
