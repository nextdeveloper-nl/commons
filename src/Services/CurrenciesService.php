<?php

namespace NextDeveloper\Commons\Services;

use NextDeveloper\Commons\Database\Models\Currencies;
use NextDeveloper\Commons\Services\AbstractServices\AbstractCurrenciesService;

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
        return Currencies::where('code', 'USD')->first();
    }
}
