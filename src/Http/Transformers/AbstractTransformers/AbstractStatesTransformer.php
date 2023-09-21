<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\States;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class StatesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractStatesTransformer extends AbstractTransformer
{

    /**
     * @param States $model
     *
     * @return array
     */
    public function transform(States $model)
    {
                        $objectId = \NextDeveloper\\Database\Models\Objects::where('id', $model->object_id)->first();
            
        return $this->buildPayload(
            [
            'id'  =>  $model->uuid,
            'name'  =>  $model->name,
            'value'  =>  $model->value,
            'reason'  =>  $model->reason,
            'object_id'  =>  $objectId ? $objectId->uuid : null,
            'object_type'  =>  $model->object_type,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
            'deleted_at'  =>  $model->deleted_at,
            ]
        );
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n


















}
