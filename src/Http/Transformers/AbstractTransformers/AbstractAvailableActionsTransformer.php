<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\AvailableActions;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class AvailableActionsTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractAvailableActionsTransformer extends AbstractTransformer
{

    /**
     * @param AvailableActions $model
     *
     * @return array
     */
    public function transform(AvailableActions $model)
    {
            
        return $this->buildPayload(
            [
            'id'  =>  $model->uuid,
            'action'  =>  $model->action,
            'description'  =>  $model->description,
            'class'  =>  $model->class,
            'input'  =>  $model->input,
            'parameters'  =>  $model->parameters,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
            'deleted_at'  =>  $model->deleted_at,
            'outputs'  =>  $model->outputs,
            ]
        );
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE




}
