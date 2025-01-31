<?php

namespace NextDeveloper\Commons\Helpers;

use Illuminate\Support\Facades\Log;
use NextDeveloper\Commons\Database\Models\ExchangeRates;

class ExchangeRateHelper
{
    /**
     * @param $fromCurrencyCode
     * @param $toCurrencyCode
     * @param $date
     * @return float
     */
    public static function convert($fromCurrencyCode, $toCurrencyCode, $amount = 1, $date = null) : float
    {
        Log::info(__METHOD__ . '| Converting ' . $amount . ' ' . $fromCurrencyCode . ' to ' . $toCurrencyCode);

        $latestExchangeRate = self::getLatestRate($fromCurrencyCode, $toCurrencyCode);

        $converted = $amount * $latestExchangeRate;

        Log::info(__METHOD__ . '| Converted ' . $amount . ' ' . $fromCurrencyCode . ' to ' . $converted . ' ' . $toCurrencyCode);

        return $converted;
    }

    public static function getLatestRate($fromCurrencyCode, $toCurrencyCode) : float
    {
        Log::info(__METHOD__. '| Trying to get latest exchange rate from ' . $fromCurrencyCode . ' to ' . $toCurrencyCode);

        if($fromCurrencyCode == $toCurrencyCode)
            return 1;

        $rate = ExchangeRates::where('local_currency_code', strtoupper($fromCurrencyCode))
            ->where('reference_currency_code', strtoupper($toCurrencyCode))
            ->orderBy('id', 'desc')
            ->first();

        if($rate)
            return $rate->rate;

        //  If there is no rate like this, we can try the opposite and divide the number by 1
        $rate = ExchangeRates::where('local_currency_code', strtoupper($toCurrencyCode))
            ->where('reference_currency_code', strtoupper($fromCurrencyCode))
            ->orderBy('id', 'desc')
            ->first();

        return 1 / $rate->rate;
    }
}
