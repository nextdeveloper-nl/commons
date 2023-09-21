<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\Domainables;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class DomainablesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractDomainablesTransformer extends AbstractTransformer
{

    /**
     * @param Domainables $model
     *
     * @return array
     */
    public function transform(Domainables $model)
    {
                        $objectId = \NextDeveloper\\Database\Models\Objects::where('id', $model->object_id)->first();
            
        return $this->buildPayload(
            [
            'id'  =>  $model->id,
            'object_id'  =>  $objectId ? $objectId->uuid : null,
            'object_type'  =>  $model->object_type,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
            ]
        );
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n


















}
