<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\CommonVote;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CommonVoteTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractCommonVoteTransformer extends AbstractTransformer {

    /**
     * @param CommonVote $model
     *
     * @return array
     */
    public function transform(CommonVote $model) {
                        $voteableId = \NextDeveloper\\Database\Models\Voteable::where('id', $model->voteable_id)->first();
                    $iamUserId = \NextDeveloper\IAM\Database\Models\IamUser::where('id', $model->iam_user_id)->first();
            
        return $this->buildPayload([
'id'  =>  $model->uuid,
'value'  =>  $model->value == 1 ? true : false,
'voteable_id'  =>  $voteableId ? $voteableId->uuid : null,
'voteable_type'  =>  $model->voteable_type,
'iam_user_id'  =>  $iamUserId ? $iamUserId->uuid : null,
'created_at'  =>  $model->created_at,
'updated_at'  =>  $model->updated_at,
'deleted_at'  =>  $model->deleted_at,
    ]);
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n






}
