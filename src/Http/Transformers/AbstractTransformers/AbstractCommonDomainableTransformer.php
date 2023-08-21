<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\CommonDomainable;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CommonDomainableTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractCommonDomainableTransformer extends AbstractTransformer {

    /**
     * @param CommonDomainable $model
     *
     * @return array
     */
    public function transform(CommonDomainable $model) {
                        $domainableId = \NextDeveloper\\Database\Models\Domainable::where('id', $model->domainable_id)->first();
            
        return $this->buildPayload([
'id'  =>  $model->id,
'domainable_id'  =>  $domainableId ? $domainableId->uuid : null,
'domainable_type'  =>  $model->domainable_type,
'created_at'  =>  $model->created_at,
'updated_at'  =>  $model->updated_at,
    ]);
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}
