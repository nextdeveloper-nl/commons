<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\CommonTag;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CommonTagTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractCommonTagTransformer extends AbstractTransformer {

    /**
     * @param CommonTag $model
     *
     * @return array
     */
    public function transform(CommonTag $model) {
                
        return $this->buildPayload([
'id'  =>  $model->uuid,
'name'  =>  $model->name,
'description'  =>  $model->description,
'slug'  =>  $model->slug,
'created_at'  =>  $model->created_at,
'updated_at'  =>  $model->updated_at,
'deleted_at'  =>  $model->deleted_at,
    ]);
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n






}
