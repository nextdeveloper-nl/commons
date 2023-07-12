<?php

namespace NextDeveloper\Commons\Http\Transformers;

use NextDeveloper\Commons\Database\Models\Comment;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CommentTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommentTransformer extends AbstractTransformer {

    /**
     * @param Comment $model
     *
     * @return array
     */
    public function transform(Comment $model) {
        return $this->buildPayload([
            'id'  =>  $model->uuid,
            'body'  =>  $model->body,
            'user_id'  =>  $model->user_id,
            'commentable_id'  =>  $model->commentable_id,
            'commentable_type'  =>  $model->commentable_type,
            '_lft'  =>  $model->_lft,
            '_rgt'  =>  $model->_rgt,
            'parent_id'  =>  $model->parent_id,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
            'deleted_at'  =>  $model->deleted_at,
        ]);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}