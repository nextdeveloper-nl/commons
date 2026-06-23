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
        $requestedUuid = is_array($params) ? ($params['iamAccountId'] ?? null) : null;

        if ($requestedUuid) {
            // A uuid was passed → only sales/admin roles may view another account's
            // addresses; anyone else is scoped back to their own account.
            $canViewOther = UserHelper::has('sales-person')
                || UserHelper::has('accounting-admin')
                || UserHelper::has('sales-manager');

            $account = $canViewOther
                ? Accounts::withoutGlobalScope(AuthorizationScope::class)->where('uuid', $requestedUuid)->first()
                : null;

            $account = $account ?: UserHelper::currentAccount();
        } else {
            $account = UserHelper::currentAccount();
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

        $data['object_id'] = $account->id;
        $data['object_type'] = Accounts::class;

        UserHelper::runAsAdmin(function () use ($data) {
            return parent::create($data);
        });
    }
}
