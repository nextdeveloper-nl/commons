<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\ProfileTags;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class ProfileTagsTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractProfileTagsTransformer extends AbstractTransformer
{

    /**
     * @param ProfileTags $model
     *
     * @return array
     */
    public function transform(ProfileTags $model)
    {
                
        return $this->buildPayload(
            [
            'id'  =>  $model->id,
            'object_type'  =>  $model->object_type,
            'object_id'  =>  $model->object_id,
            'name'  =>  $model->name,
            'description'  =>  $model->description,
            'slug'  =>  $model->slug,
            ]
        );
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n


}
