<?php

namespace NextDeveloper\Commons\Http\Transformers;

use NextDeveloper\Commons\Database\Models\CommonDomain;
use NextDeveloper\Commons\Http\Transformers\AbstractTransformer;

/**
 * Class CommonDomainTransformer. This class is being used to manipulate the data we are serving to the customer
 *
 * @package NextDeveloper\Commons\Http\Transformers
 */
class CommonDomainTransformer extends AbstractTransformer
{

    /**
     * @param CommonDomain $model
     *
     * @return array
     */
    public function transform(CommonDomain $model)
    {
        $iamAccountId = \NextDeveloper\IAM\Database\Models\IamAccount::where('id', $model->iam_account_id)->first();
        $iamUserId = \NextDeveloper\IAM\Database\Models\IamUser::where('id', $model->iam_user_id)->first();

        return $this->buildPayload([
            'id' => $model->uuid,
            'iam_account_id' => $iamAccountId->uuid,
            'iam_user_id' => $iamUserId->uuid,
            'name' => $model->name,
            'is_active' => $model->is_active,
            'is_local_domain' => $model->is_local_domain,
            'is_locked' => $model->is_locked,
            'is_shared_domain' => $model->is_shared_domain == 1 ? true : false,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
            'deleted_at' => $model->deleted_at,
        ]);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}