<?php

namespace NextDeveloper\Commons\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use NextDeveloper\Commons\Database\Models\Currencies;
use NextDeveloper\Commons\Database\Models\ExchangeRates;
use NextDeveloper\Commons\Exceptions\ModelNotFoundException;

class ExchangeRateHelper
{
    public static function getCurrencyFromId($currency)
    {
        return Currencies::where('id', $currency)->first();
    }

    public static function convertById($fromCurrencyCode, $toCurrencyCode, $amount = 1, $date = null) : float
    {
        $currencyFrom = Currencies::where('id', $fromCurrencyCode)->first();
        $currencyTo = Currencies::where('id', $toCurrencyCode)->first();

        if(!$currencyFrom) throw new ModelNotFoundException('Currency not found with id: ' . $fromCurrencyCode);
        if(!$currencyTo) throw new ModelNotFoundException('Currency not found with id: ' . $toCurrencyCode);

        return self::convert($currencyFrom->code, $currencyTo->code, $amount, $date);
    }

    /**
     * @param $fromCurrencyCode
     * @param $toCurrencyCode
     * @param $date
     * @return float
     */
    public static function convert($fromCurrencyCode, $toCurrencyCode, $amount = 1, $date = null) : float
    {
        if($amount == 0)
            return 0;

        Log::info(__METHOD__ . '| Converting ' . $amount . ' ' . $fromCurrencyCode . ' to ' . $toCurrencyCode);

        $latestExchangeRate = self::getLatestRate($fromCurrencyCode, $toCurrencyCode);

        Log::info(__METHOD__ . ' | Latest exchange rate from ' . $fromCurrencyCode . ' to ' . $toCurrencyCode . ' is: ' . $latestExchangeRate);

        $converted = $amount * $latestExchangeRate;

        Log::info(__METHOD__ . '| Converted ' . $amount . ' ' . $fromCurrencyCode . ' to ' . $converted . ' ' . $toCurrencyCode);

        return $converted;
    }

    public static function getLatestRateById($fromCurrencyId, $toCurrencyId)
    {
        $currencyFrom = Currencies::where('id', $fromCurrencyId)->first();
        $currencyTo = Currencies::where('id', $toCurrencyId)->first();

        if(!$currencyFrom) throw new ModelNotFoundException('Currency not found with id: ' . $fromCurrencyId);
        if(!$currencyTo) throw new ModelNotFoundException('Currency not found with id: ' . $toCurrencyId);

        return self::getLatestRate($currencyFrom->code, $currencyTo->code);
    }

    public static function getLatestRate($fromCurrencyCode, $toCurrencyCode) : float
    {
        Log::info(__METHOD__. '| Trying to get latest exchange rate from ' . $fromCurrencyCode . ' to ' . $toCurrencyCode);

        $cacheKey = 'latest_exchange_rate_' . $fromCurrencyCode . '_' . $toCurrencyCode;

        if(Cache::has($cacheKey)) {
            Log::info(__METHOD__ . '| Found exchange rate in cache');
            return Cache::get($cacheKey);
        }

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

        Cache::set($cacheKey, 1 / $rate->rate, 60 * 60);

        return 1 / $rate->rate;
    }
}
