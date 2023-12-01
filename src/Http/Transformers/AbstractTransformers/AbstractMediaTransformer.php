<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\Media;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class MediaTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractMediaTransformer extends AbstractTransformer
{

    /**
     * @param Media $model
     *
     * @return array
     */
    public function transform(Media $model)
    {
                
        return $this->buildPayload(
            [
            'id'  =>  $model->uuid,
            'object_id'  =>  $model->object_id,
            'object_type'  =>  $model->object_type,
            'collection_name'  =>  $model->collection_name,
            'name'  =>  $model->name,
            'cdn_url'  =>  $model->cdn_url,
            'file_name'  =>  $model->file_name,
            'mime_type'  =>  $model->mime_type,
            'disk'  =>  $model->disk,
            'size'  =>  $model->size,
            'manipulations'  =>  $model->manipulations,
            'custom_properties'  =>  $model->custom_properties,
            'order_column'  =>  $model->order_column,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
            'deleted_at'  =>  $model->deleted_at,
            ]
        );
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n































}
