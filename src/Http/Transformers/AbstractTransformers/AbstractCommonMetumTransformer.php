<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\CommonMetum;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CommonMetumTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractCommonMetumTransformer extends AbstractTransformer {

    /**
     * @param CommonMetum $model
     *
     * @return array
     */
    public function transform(CommonMetum $model) {
                        $metableId = \NextDeveloper\\Database\Models\Metable::where('id', $model->metable_id)->first();
            
        return $this->buildPayload([
'id'  =>  $model->id,
'metable_id'  =>  $metableId ? $metableId->uuid : null,
'metable_type'  =>  $model->metable_type,
'key'  =>  $model->key,
'value'  =>  $model->value,
    ]);
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n







}
