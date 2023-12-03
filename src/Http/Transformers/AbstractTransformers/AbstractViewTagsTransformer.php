<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\ViewTags;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class ViewTagsTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractViewTagsTransformer extends AbstractTransformer
{

    /**
     * @param ViewTags $model
     *
     * @return array
     */
    public function transform(ViewTags $model)
    {
            
        return $this->buildPayload(
            [
            'id'  =>  $model->uuid,
            'object_type'  =>  $model->object_type,
            'object_id'  =>  $model->object_id,
            'name'  =>  $model->name,
            'description'  =>  $model->description,
            'slug'  =>  $model->slug,
            ]
        );
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n









}
