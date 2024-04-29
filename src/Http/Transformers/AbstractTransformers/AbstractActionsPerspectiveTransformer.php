<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\ActionsPerspective;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class ActionsPerspectiveTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractActionsPerspectiveTransformer extends AbstractTransformer
{

    /**
     * @param ActionsPerspective $model
     *
     * @return array
     */
    public function transform(ActionsPerspective $model)
    {
                        $iamUserId = \NextDeveloper\IAM\Database\Models\Users::where('id', $model->iam_user_id)->first();
                    $iamAccountId = \NextDeveloper\IAM\Database\Models\Accounts::where('id', $model->iam_account_id)->first();
        
        return $this->buildPayload(
            [
            'id'  =>  $model->uuid,
            'action'  =>  $model->action,
            'progress'  =>  $model->progress,
            'runtime'  =>  $model->runtime,
            'object_id'  =>  $model->object_id,
            'object_type'  =>  $model->object_type,
            'iam_user_id'  =>  $iamUserId ? $iamUserId->uuid : null,
            'iam_account_id'  =>  $iamAccountId ? $iamAccountId->uuid : null,
            'created_at'  =>  $model->created_at,
            'updated_at'  =>  $model->updated_at,
            'ca_uuid'  =>  $model->ca_uuid,
            'log'  =>  $model->log,
            'subaction_runtime'  =>  $model->subaction_runtime,
            ]
        );
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE



}
