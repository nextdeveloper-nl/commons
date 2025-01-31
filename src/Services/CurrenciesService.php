<?php

namespace NextDeveloper\Commons\Services;

use NextDeveloper\Commons\Database\Models\Currencies;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCurrenciesService;
use NextDeveloper\IAM\Database\Models\Accounts;
use NextDeveloper\IAM\Database\Scopes\AuthorizationScope;
use NextDeveloper\IAM\Helpers\UserHelper;

/**
 * This class is responsible from managing the data for Currencies
 *
 * Class CurrenciesService.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class CurrenciesService extends AbstractCurrenciesService
{

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
    public static function getDefaultCurrency()
    {
        return self::getCurrencyOfAccount(UserHelper::currentAccount());
    }

    public static function getCurrecyByCode($code)
    {
        return Currencies::where('code', $code)->first();
    }

    public static function getCurrencyById($id)
    {
        $currency = Currencies::where('id', $id)->first();

        if($currency)
            return $currency;

        return self::getDefaultCurrency();
    }

    public static function getCurrencyOfAccount(Accounts $account)
    {
        if(class_exists(\NextDeveloper\Accounting\Database\Models\Accounts::class)) {
            $account = \NextDeveloper\Accounting\Database\Models\Accounts::withoutGlobalScope(AuthorizationScope::class)
                ->where('iam_account_id', $account->id)
                ->first();

            return self::getCurrencyById($account->common_currency_id);
        }

        return Currencies::where('code', config('leo.default_currency_code'))->first();
    }
}
