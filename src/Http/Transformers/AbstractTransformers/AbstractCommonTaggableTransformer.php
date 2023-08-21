<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\CommonTaggable;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CommonTaggableTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractCommonTaggableTransformer extends AbstractTransformer {

    /**
     * @param CommonTaggable $model
     *
     * @return array
     */
    public function transform(CommonTaggable $model) {
                        $tagId = \NextDeveloper\\Database\Models\Tag::where('id', $model->tag_id)->first();
                    $taggableId = \NextDeveloper\\Database\Models\Taggable::where('id', $model->taggable_id)->first();
            
        return $this->buildPayload([
'id'  =>  $model->id,
'tag_id'  =>  $tagId ? $tagId->uuid : null,
'taggable_id'  =>  $taggableId ? $taggableId->uuid : null,
'taggable_type'  =>  $model->taggable_type,
'created_at'  =>  $model->created_at,
'updated_at'  =>  $model->updated_at,
    ]);
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}
