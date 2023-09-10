<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\Domainables;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class DomainablesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractDomainablesTransformer extends AbstractTransformer {

    /**
     * @param Domainables $model
     *
     * @return array
     */
    public function transform(Domainables $model) {
                        $domainableId = \NextDeveloper\\Database\Models\Domainables::where('id', $model->domainable_id)->first();
            
        return $this->buildPayload([
'id'  =>  $model->id,
'domainable_id'  =>  $domainableId ? $domainableId->uuid : null,
'domainable_type'  =>  $model->domainable_type,
'created_at'  =>  $model->created_at,
'updated_at'  =>  $model->updated_at,
    ]);
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n



}
