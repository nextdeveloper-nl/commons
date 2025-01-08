<?php
namespace NextDeveloper\Commons\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use NextDeveloper\Commons\Database\Models\Countries;
use NextDeveloper\Commons\Database\Models\ExchangeRates;

/**
 * Class FetchExchangeRateCommand
 *
 * This command fetches exchange rates from an external API and updates the database
 * with the latest rates corresponding to different countries' currencies.
 */
class FetchExchangeRateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'common:fetch-exchange-rate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch exchange rates from an external API and update the database.';

    /**
     * HTTP client instance for making requests.
     *
     * @var Client
     */
    protected Client $client;

    /**
     * The URL of the external API to fetch exchange rates from.
     */
    private $API_URL;

    /**
     * FetchExchangeRateCommand constructor.
     *
     * Initializes the HTTP client with the API settings.
     */
    public function __construct()
    {
        parent::__construct();

        $this->API_URL = config('commons.exchange_rate.url');

        $this->client = new Client([
            'headers' => [
                'Accept' => 'application/xml',
            ],
        ]);
    }

    /**
     * Execute the console command.
     *
     * Fetches the list of countries from the database, queries the external API to get
     * the latest exchange rates, and updates the ExchangeRates table accordingly.
     *
     * @return void
     */
    public function handle(): void
    {
        // Fetch all countries from the database
        $countries = Countries::query()
            ->withoutGlobalScopes()
            ->get();

        // Fetch exchange rate currencies from external API
        $currencies = $this->fetchCurrencies();

        Log::info('Fetched exchange rates from the API' . PHP_EOL . json_encode($currencies, JSON_PRETTY_PRINT));

        // Process each currency and update the database
        foreach ($currencies as $currency) {
            $currencyCode = (string)$currency->attributes()->CurrencyCode;
            $forexRate = (float)str_replace(',', '.', $currency->ForexBuying);
            $associatedCountry = $countries->firstWhere('currency_code', $currencyCode);

            if ($associatedCountry) {
                $this->updateOrCreateExchangeRate($associatedCountry->id, $currencyCode, $forexRate);
            }
        }
    }

    /**
     * Fetch exchange rates from the external API.
     *
     * Uses asynchronous requests to fetch data from the configured API URL.
     *
     */
    private function fetchCurrencies()
    {
        // Use sendAsync for asynchronous fetching
        $promise = $this->client->getAsync($this->API_URL);

        return $promise->then(
        // Handle successful API response
            function ($response) {
                $xml = simplexml_load_string($response->getBody());
                return $xml->Currency ?? [];
            },
            // Handle API request errors
            function ($exception) {
                $this->error('Failed to fetch currencies: ' . $exception->getMessage());
                return [];
            }
        )->wait(); // Wait for the Promise to resolve/reject and return processed data
    }

    /**
     * Update or create an exchange rate record in the database.
     *
     * @param int $countryId The ID of the country associated with the currency.
     * @param string $currencyCode The currency code (ISO 4217 format).
     * @param float $rate The exchange rate for the currency.
     *
     * @return void
     */
    private function updateOrCreateExchangeRate(int $countryId, string $currencyCode, float $rate): void
    {
        // Attempt to find an existing exchange rate record
        $exchangeRate = ExchangeRates::query()
            ->withoutGlobalScopes()
            ->where('common_country_id', $countryId)
            ->where('code', $currencyCode)
            ->first();

        // Update the record if it exists, otherwise create a new one
        if ($exchangeRate) {
            $exchangeRate->updateQuietly([
                'rate'          => $rate,
                'last_modified' => now(),
            ]);
        } else {
            ExchangeRates::query()
                ->forceCreateQuietly([
                    'common_country_id' => $countryId,
                    'code'              => $currencyCode,
                    'rate'              => $rate,
                    'last_modified'     => now(),
                ]);
        }
    }
}