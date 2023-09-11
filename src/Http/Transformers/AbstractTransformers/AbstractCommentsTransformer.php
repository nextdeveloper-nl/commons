<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\Comments;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CommentsTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractCommentsTransformer extends AbstractTransformer
{

    /**
     * @param Comments $model
     *
     * @return array
     */
    public function transform(Comments $model)
    {
                        $iamUserId = \NextDeveloper\IAM\Database\Models\Users::where('id', $model->iam_user_id)->first();
                    $commentableId = \NextDeveloper\\Database\Models\Commentables::where('id', $model->commentable_id)->first();
                    $parentId = \NextDeveloper\\Database\Models\Parents::where('id', $model->parent_id)->first();
            
        return $this->buildPayload(
            [
            'id'  =>  $model->uuid,
            'body'  =>  $model->body,
            'iam_user_id'  =>  $iamUserId ? $iamUserId->uuid : null,
            'commentable_id'  =>  $commentableId ? $commentableId->uuid : null,
            'commentable_type'  =>  $model->commentable_type,
            '_lft'  =>  $model->_lft,
            '_rgt'  =>  $model->_rgt,
            'parent_id'  =>  $parentId ? $parentId->uuid : null,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
            'deleted_at'  =>  $model->deleted_at,
            ]
        );
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n





}