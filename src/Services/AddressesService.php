<?php

namespace NextDeveloper\Commons\Services;

use NextDeveloper\Commons\Database\Models\Addresses;
use NextDeveloper\Commons\Services\AbstractServices\AbstractAddressesService;
use NextDeveloper\IAM\Database\Models\Accounts;
use NextDeveloper\IAM\Database\Scopes\AuthorizationScope;
use NextDeveloper\IAM\Helpers\UserHelper;

/**
 * This class is responsible from managing the data for Addresses
 *
 * Class AddressesService.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class AddressesService extends AbstractAddressesService
{
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

    public static function getMyAddresses()
    {
        return Addresses::withoutGlobalScope(AuthorizationScope::class)
            ->where('iam_account_id', UserHelper::currentAccount()->id)
            ->get();
    }

    public static function getAddresses($params)
    {
        $account = UserHelper::currentAccount();

        if(
            UserHelper::has('sales-person') ||
            UserHelper::has('accounting-admin') ||
            UserHelper::has('sales-manager')
        ) {
            $account = Accounts::withoutGlobalScope(AuthorizationScope::class)
                ->where('uuid', $params['iamAccountId'])
                ->first();
        }

        return Addresses::withoutGlobalScope(AuthorizationScope::class)
            ->where('iam_account_id', $account->id)
            ->get();
    }

    public static function create($data)
    {
        $data['object_id']  =   UserHelper::currentAccount()->id;
        $data['object_type'] =   Accounts::class;

        return parent::create($data);
    }
}
