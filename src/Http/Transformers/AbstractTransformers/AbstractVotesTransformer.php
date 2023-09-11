<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\Votes;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class VotesTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractVotesTransformer extends AbstractTransformer
{

    /**
     * @param Votes $model
     *
     * @return array
     */
    public function transform(Votes $model)
    {
                        $voteableId = \NextDeveloper\\Database\Models\Voteables::where('id', $model->voteable_id)->first();
                    $iamUserId = \NextDeveloper\IAM\Database\Models\Users::where('id', $model->iam_user_id)->first();
            
        return $this->buildPayload(
            [
            'id'  =>  $model->uuid,
            'value'  =>  $model->value == 1 ? true : false,
            'voteable_id'  =>  $voteableId ? $voteableId->uuid : null,
            'voteable_type'  =>  $model->voteable_type,
            'iam_user_id'  =>  $iamUserId ? $iamUserId->uuid : null,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
            'deleted_at'  =>  $model->deleted_at,
            ]
        );
    }
    
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n





}