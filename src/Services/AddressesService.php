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

    public static function accountHasInvoiceAddress(int $iamAccountId): bool
    {
        return Addresses::withoutGlobalScope(AuthorizationScope::class)
            ->where('iam_account_id', $iamAccountId)
            ->where('is_invoice_address', true)
            ->exists();
    }

    /**
     * Marks the given address (by uuid, scoped to the current account) as the sole
     * invoice address, clearing the flag from any other address on the account.
     */
    public static function setInvoiceAddress(string $uuid): void
    {
        $accountId = UserHelper::currentAccount()->id;

        $target = Addresses::withoutGlobalScope(AuthorizationScope::class)
            ->where('iam_account_id', $accountId)
            ->where('uuid', $uuid)
            ->firstOrFail();

        UserHelper::runAsAdmin(function () use ($accountId, $target) {
            Addresses::withoutGlobalScope(AuthorizationScope::class)
                ->where('iam_account_id', $accountId)
                ->where('is_invoice_address', true)
                ->where('id', '!=', $target->id)
                ->get()
                ->each(function ($address) {
                    $address->update(['is_invoice_address' => false]);
                });

            $target->update(['is_invoice_address' => true]);
        });
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
        $account = Accounts::withoutGlobalScope(AuthorizationScope::class)
            ->where('uuid', $data['iam_account_id'])
            ->first();

        $data['object_id']  =   $account->id;
        $data['object_type'] =   Accounts::class;

        UserHelper::runAsAdmin(function () use ($data) {
            return parent::create($data);
        });
    }
}
