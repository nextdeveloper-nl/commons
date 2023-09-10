<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\States;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class StatesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractStatesTransformer extends AbstractTransformer {

    /**
     * @param States $model
     *
     * @return array
     */
    public function transform(States $model) {
                        $modelId = \NextDeveloper\\Database\Models\Models::where('id', $model->model_id)->first();
            
        return $this->buildPayload([
'id'  =>  $model->uuid,
'name'  =>  $model->name,
'value'  =>  $model->value,
'reason'  =>  $model->reason,
'model_id'  =>  $modelId ? $modelId->uuid : null,
'model_type'  =>  $model->model_type,
'created_at'  =>  $model->created_at,
'updated_at'  =>  $model->updated_at,
'deleted_at'  =>  $model->deleted_at,
    ]);
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n



}
