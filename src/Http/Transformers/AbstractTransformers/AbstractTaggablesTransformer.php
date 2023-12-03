<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\Taggables;
use NextDeveloper\Commons\Helpers\TagHelper;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class TaggablesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractTaggablesTransformer extends AbstractTransformer
{

    /**
     * @param Taggables $model
     *
     * @return array
     */
    public function transform(Taggables $model)
    {
                        $commonTagsId = \NextDeveloper\Commons\Database\Models\Tags::where('id', $model->common_tags_id)->first();
        
        return $this->buildPayload(
            [
            'id'  =>  $model->uuid,
            'common_tags_id'  =>  $commonTagsId ? $commonTagsId->uuid : null,
            'object_id'  =>  $model->object_id,
            'object_type'  =>  $model->object_type,
            'created_at'  =>  $model->created_at ? $model->created_at->toIso8601String() : null,
            'updated_at'  =>  $model->updated_at ? $model->updated_at->toIso8601String() : null,
            ]
        );
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n










}
