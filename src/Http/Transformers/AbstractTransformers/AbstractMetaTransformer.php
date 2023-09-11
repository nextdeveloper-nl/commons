<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\Meta;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class MetaTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractMetaTransformer extends AbstractTransformer
{

    /**
     * @param Meta $model
     *
     * @return array
     */
    public function transform(Meta $model)
    {
                        $metableId = \NextDeveloper\\Database\Models\Metables::where('id', $model->metable_id)->first();
            
        return $this->buildPayload(
            [
            'id'  =>  $model->id,
            'metable_id'  =>  $metableId ? $metableId->uuid : null,
            'metable_type'  =>  $model->metable_type,
            'key'  =>  $model->key,
            'value'  =>  $model->value,
            ]
        );
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n





}
