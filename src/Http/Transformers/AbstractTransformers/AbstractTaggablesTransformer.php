<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\Taggables;
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
                        $tagId = \NextDeveloper\\Database\Models\Tags::where('id', $model->tag_id)->first();
                    $taggableId = \NextDeveloper\\Database\Models\Taggables::where('id', $model->taggable_id)->first();
            
        return $this->buildPayload(
            [
            'id'  =>  $model->id,
            'tag_id'  =>  $tagId ? $tagId->uuid : null,
            'taggable_id'  =>  $taggableId ? $taggableId->uuid : null,
            'taggable_type'  =>  $model->taggable_type,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
            ]
        );
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n





}
