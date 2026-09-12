<?php

namespace NextDeveloper\Commons\Services;

use NextDeveloper\Commons\Services\AbstractServices\AbstractMetaService;
use NextDeveloper\IAM\Helpers\UserHelper;

/**
 * This class is responsible from managing the data for Meta
 *
 * Class MetaService.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class MetaService extends AbstractMetaService
{

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

    /**
     * Stamps the owning user/account before creating the Meta row so that
     * AuthorizationScope can restrict access to the token owner, then
     * delegates to the base implementation. Client-supplied
     * iam_user_id/iam_account_id are always overwritten here.
     *
     * @param  array $data
     * @return mixed
     */
    public static function create(array $data)
    {
        $data['iam_account_id'] = UserHelper::currentAccount()->id;
        $data['iam_user_id'] = UserHelper::me()->id;

        return parent::create($data);
    }
}