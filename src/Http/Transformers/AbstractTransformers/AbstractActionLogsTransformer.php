<?php

namespace NextDeveloper\Commons\Http\Transformers\AbstractTransformers;

use NextDeveloper\Commons\Database\Models\ActionLogs;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class ActionLogsTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class AbstractActionLogsTransformer extends AbstractTransformer
{

    /**
     * @param ActionLogs $model
     *
     * @return array
     */
    public function transform(ActionLogs $model)
    {
                        $commonActionId = \NextDeveloper\Commons\Database\Models\Actions::where('id', $model->common_action_id)->first();
                    $iamAccountId = \NextDeveloper\IAM\Database\Models\Accounts::where('id', $model->iam_account_id)->first();
                    $iamUserId = \NextDeveloper\IAM\Database\Models\Users::where('id', $model->iam_user_id)->first();
        
        return $this->buildPayload(
            [
            'id'  =>  $model->uuid,
            'common_action_id'  =>  $commonActionId ? $commonActionId->uuid : null,
            'log'  =>  $model->log,
            'runtime'  =>  $model->runtime,
            'created_at'  =>  $model->created_at,
            'iam_account_id'  =>  $iamAccountId ? $iamAccountId->uuid : null,
            'iam_user_id'  =>  $iamUserId ? $iamUserId->uuid : null,
            ]
        );
    }

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
























}
