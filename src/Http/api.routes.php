<?php

Route::prefix('commons')->group(
    function () {
        Route::prefix('currencies')->group(
            function () {
                Route::get('/', 'Currencies\CurrenciesController@index');
                Route::get('/actions', 'Currencies\CurrenciesController@getActions');

                Route::get('{common_currencies}/tags ', 'Currencies\CurrenciesController@tags');
                Route::post('{common_currencies}/tags ', 'Currencies\CurrenciesController@saveTags');
                Route::get('{common_currencies}/addresses ', 'Currencies\CurrenciesController@addresses');
                Route::post('{common_currencies}/addresses ', 'Currencies\CurrenciesController@saveAddresses');

                Route::get('/{common_currencies}/{subObjects}', 'Currencies\CurrenciesController@relatedObjects');
                Route::get('/{common_currencies}', 'Currencies\CurrenciesController@show');

                Route::post('/', 'Currencies\CurrenciesController@store');
                Route::post('/{common_currencies}/do/{action}', 'Currencies\CurrenciesController@doAction');

                Route::patch('/{common_currencies}', 'Currencies\CurrenciesController@update');
                Route::delete('/{common_currencies}', 'Currencies\CurrenciesController@destroy');
            }
        );

        Route::prefix('addresses')->group(
            function () {
                Route::get('/', 'Addresses\AddressesController@index');
                Route::get('/actions', 'Addresses\AddressesController@getActions');

                Route::get('{common_addresses}/tags ', 'Addresses\AddressesController@tags');
                Route::post('{common_addresses}/tags ', 'Addresses\AddressesController@saveTags');
                Route::get('{common_addresses}/addresses ', 'Addresses\AddressesController@addresses');
                Route::post('{common_addresses}/addresses ', 'Addresses\AddressesController@saveAddresses');

                Route::get('/{common_addresses}/{subObjects}', 'Addresses\AddressesController@relatedObjects');
                Route::get('/{common_addresses}', 'Addresses\AddressesController@show');

                Route::post('/', 'Addresses\AddressesController@store');
                Route::post('/{common_addresses}/do/{action}', 'Addresses\AddressesController@doAction');

                Route::patch('/{common_addresses}', 'Addresses\AddressesController@update');
                Route::delete('/{common_addresses}', 'Addresses\AddressesController@destroy');
            }
        );

        Route::prefix('actions')->group(
            function () {
                Route::get('/', 'Actions\ActionsController@index');
                Route::get('/actions', 'Actions\ActionsController@getActions');

                Route::get('{common_actions}/tags ', 'Actions\ActionsController@tags');
                Route::post('{common_actions}/tags ', 'Actions\ActionsController@saveTags');
                Route::get('{common_actions}/addresses ', 'Actions\ActionsController@addresses');
                Route::post('{common_actions}/addresses ', 'Actions\ActionsController@saveAddresses');

                Route::get('/{common_actions}/{subObjects}', 'Actions\ActionsController@relatedObjects');
                Route::get('/{common_actions}', 'Actions\ActionsController@show');

                Route::post('/', 'Actions\ActionsController@store');
                Route::post('/{common_actions}/do/{action}', 'Actions\ActionsController@doAction');

                Route::patch('/{common_actions}', 'Actions\ActionsController@update');
                Route::delete('/{common_actions}', 'Actions\ActionsController@destroy');
            }
        );

        Route::prefix('domains')->group(
            function () {
                Route::get('/', 'Domains\DomainsController@index');
                Route::get('/actions', 'Domains\DomainsController@getActions');

                Route::get('{common_domains}/tags ', 'Domains\DomainsController@tags');
                Route::post('{common_domains}/tags ', 'Domains\DomainsController@saveTags');
                Route::get('{common_domains}/addresses ', 'Domains\DomainsController@addresses');
                Route::post('{common_domains}/addresses ', 'Domains\DomainsController@saveAddresses');

                Route::get('/{common_domains}/{subObjects}', 'Domains\DomainsController@relatedObjects');
                Route::get('/{common_domains}', 'Domains\DomainsController@show');

                Route::post('/', 'Domains\DomainsController@store');
                Route::post('/{common_domains}/do/{action}', 'Domains\DomainsController@doAction');

                Route::patch('/{common_domains}', 'Domains\DomainsController@update');
                Route::delete('/{common_domains}', 'Domains\DomainsController@destroy');
            }
        );

        Route::prefix('available-actions')->group(
            function () {
                Route::get('/', 'AvailableActions\AvailableActionsController@index');
                Route::get('/actions', 'AvailableActions\AvailableActionsController@getActions');

                Route::get('{common_available_actions}/tags ', 'AvailableActions\AvailableActionsController@tags');
                Route::post('{common_available_actions}/tags ', 'AvailableActions\AvailableActionsController@saveTags');
                Route::get('{common_available_actions}/addresses ', 'AvailableActions\AvailableActionsController@addresses');
                Route::post('{common_available_actions}/addresses ', 'AvailableActions\AvailableActionsController@saveAddresses');

                Route::get('/{common_available_actions}/{subObjects}', 'AvailableActions\AvailableActionsController@relatedObjects');
                Route::get('/{common_available_actions}', 'AvailableActions\AvailableActionsController@show');

                Route::post('/', 'AvailableActions\AvailableActionsController@store');
                Route::post('/{common_available_actions}/do/{action}', 'AvailableActions\AvailableActionsController@doAction');

                Route::patch('/{common_available_actions}', 'AvailableActions\AvailableActionsController@update');
                Route::delete('/{common_available_actions}', 'AvailableActions\AvailableActionsController@destroy');
            }
        );

        Route::prefix('categories')->group(
            function () {
                Route::get('/', 'Categories\CategoriesController@index');
                Route::get('/actions', 'Categories\CategoriesController@getActions');

                Route::get('{common_categories}/tags ', 'Categories\CategoriesController@tags');
                Route::post('{common_categories}/tags ', 'Categories\CategoriesController@saveTags');
                Route::get('{common_categories}/addresses ', 'Categories\CategoriesController@addresses');
                Route::post('{common_categories}/addresses ', 'Categories\CategoriesController@saveAddresses');

                Route::get('/{common_categories}/{subObjects}', 'Categories\CategoriesController@relatedObjects');
                Route::get('/{common_categories}', 'Categories\CategoriesController@show');

                Route::post('/', 'Categories\CategoriesController@store');
                Route::post('/{common_categories}/do/{action}', 'Categories\CategoriesController@doAction');

                Route::patch('/{common_categories}', 'Categories\CategoriesController@update');
                Route::delete('/{common_categories}', 'Categories\CategoriesController@destroy');
            }
        );

        Route::prefix('action-logs')->group(
            function () {
                Route::get('/', 'ActionLogs\ActionLogsController@index');
                Route::get('/actions', 'ActionLogs\ActionLogsController@getActions');

                Route::get('{common_action_logs}/tags ', 'ActionLogs\ActionLogsController@tags');
                Route::post('{common_action_logs}/tags ', 'ActionLogs\ActionLogsController@saveTags');
                Route::get('{common_action_logs}/addresses ', 'ActionLogs\ActionLogsController@addresses');
                Route::post('{common_action_logs}/addresses ', 'ActionLogs\ActionLogsController@saveAddresses');

                Route::get('/{common_action_logs}/{subObjects}', 'ActionLogs\ActionLogsController@relatedObjects');
                Route::get('/{common_action_logs}', 'ActionLogs\ActionLogsController@show');

                Route::post('/', 'ActionLogs\ActionLogsController@store');
                Route::post('/{common_action_logs}/do/{action}', 'ActionLogs\ActionLogsController@doAction');

                Route::patch('/{common_action_logs}', 'ActionLogs\ActionLogsController@update');
                Route::delete('/{common_action_logs}', 'ActionLogs\ActionLogsController@destroy');
            }
        );

        Route::prefix('countries')->group(
            function () {
                Route::get('/', 'Countries\CountriesController@index');
                Route::get('/actions', 'Countries\CountriesController@getActions');

                Route::get('{common_countries}/tags ', 'Countries\CountriesController@tags');
                Route::post('{common_countries}/tags ', 'Countries\CountriesController@saveTags');
                Route::get('{common_countries}/addresses ', 'Countries\CountriesController@addresses');
                Route::post('{common_countries}/addresses ', 'Countries\CountriesController@saveAddresses');

                Route::get('/{common_countries}/{subObjects}', 'Countries\CountriesController@relatedObjects');
                Route::get('/{common_countries}', 'Countries\CountriesController@show');

                Route::post('/', 'Countries\CountriesController@store');
                Route::post('/{common_countries}/do/{action}', 'Countries\CountriesController@doAction');

                Route::patch('/{common_countries}', 'Countries\CountriesController@update');
                Route::delete('/{common_countries}', 'Countries\CountriesController@destroy');
            }
        );

        Route::prefix('exchange-rates')->group(
            function () {
                Route::get('/', 'ExchangeRates\ExchangeRatesController@index');
                Route::get('/actions', 'ExchangeRates\ExchangeRatesController@getActions');

                Route::get('{common_exchange_rates}/tags ', 'ExchangeRates\ExchangeRatesController@tags');
                Route::post('{common_exchange_rates}/tags ', 'ExchangeRates\ExchangeRatesController@saveTags');
                Route::get('{common_exchange_rates}/addresses ', 'ExchangeRates\ExchangeRatesController@addresses');
                Route::post('{common_exchange_rates}/addresses ', 'ExchangeRates\ExchangeRatesController@saveAddresses');

                Route::get('/{common_exchange_rates}/{subObjects}', 'ExchangeRates\ExchangeRatesController@relatedObjects');
                Route::get('/{common_exchange_rates}', 'ExchangeRates\ExchangeRatesController@show');

                Route::post('/', 'ExchangeRates\ExchangeRatesController@store');
                Route::post('/{common_exchange_rates}/do/{action}', 'ExchangeRates\ExchangeRatesController@doAction');

                Route::patch('/{common_exchange_rates}', 'ExchangeRates\ExchangeRatesController@update');
                Route::delete('/{common_exchange_rates}', 'ExchangeRates\ExchangeRatesController@destroy');
            }
        );

        Route::prefix('external-services')->group(
            function () {
                Route::get('/', 'ExternalServices\ExternalServicesController@index');
                Route::get('/actions', 'ExternalServices\ExternalServicesController@getActions');

                Route::get('{common_external_services}/tags ', 'ExternalServices\ExternalServicesController@tags');
                Route::post('{common_external_services}/tags ', 'ExternalServices\ExternalServicesController@saveTags');
                Route::get('{common_external_services}/addresses ', 'ExternalServices\ExternalServicesController@addresses');
                Route::post('{common_external_services}/addresses ', 'ExternalServices\ExternalServicesController@saveAddresses');

                Route::get('/{common_external_services}/{subObjects}', 'ExternalServices\ExternalServicesController@relatedObjects');
                Route::get('/{common_external_services}', 'ExternalServices\ExternalServicesController@show');

                Route::post('/', 'ExternalServices\ExternalServicesController@store');
                Route::post('/{common_external_services}/do/{action}', 'ExternalServices\ExternalServicesController@doAction');

                Route::patch('/{common_external_services}', 'ExternalServices\ExternalServicesController@update');
                Route::delete('/{common_external_services}', 'ExternalServices\ExternalServicesController@destroy');
            }
        );

        Route::prefix('languages')->group(
            function () {
                Route::get('/', 'Languages\LanguagesController@index');
                Route::get('/actions', 'Languages\LanguagesController@getActions');

                Route::get('{common_languages}/tags ', 'Languages\LanguagesController@tags');
                Route::post('{common_languages}/tags ', 'Languages\LanguagesController@saveTags');
                Route::get('{common_languages}/addresses ', 'Languages\LanguagesController@addresses');
                Route::post('{common_languages}/addresses ', 'Languages\LanguagesController@saveAddresses');

                Route::get('/{common_languages}/{subObjects}', 'Languages\LanguagesController@relatedObjects');
                Route::get('/{common_languages}', 'Languages\LanguagesController@show');

                Route::post('/', 'Languages\LanguagesController@store');
                Route::post('/{common_languages}/do/{action}', 'Languages\LanguagesController@doAction');

                Route::patch('/{common_languages}', 'Languages\LanguagesController@update');
                Route::delete('/{common_languages}', 'Languages\LanguagesController@destroy');
            }
        );

        Route::prefix('country-states')->group(
            function () {
                Route::get('/', 'CountryStates\CountryStatesController@index');
                Route::get('/actions', 'CountryStates\CountryStatesController@getActions');

                Route::get('{common_country_states}/tags ', 'CountryStates\CountryStatesController@tags');
                Route::post('{common_country_states}/tags ', 'CountryStates\CountryStatesController@saveTags');
                Route::get('{common_country_states}/addresses ', 'CountryStates\CountryStatesController@addresses');
                Route::post('{common_country_states}/addresses ', 'CountryStates\CountryStatesController@saveAddresses');

                Route::get('/{common_country_states}/{subObjects}', 'CountryStates\CountryStatesController@relatedObjects');
                Route::get('/{common_country_states}', 'CountryStates\CountryStatesController@show');

                Route::post('/', 'CountryStates\CountryStatesController@store');
                Route::post('/{common_country_states}/do/{action}', 'CountryStates\CountryStatesController@doAction');

                Route::patch('/{common_country_states}', 'CountryStates\CountryStatesController@update');
                Route::delete('/{common_country_states}', 'CountryStates\CountryStatesController@destroy');
            }
        );

        Route::prefix('keywords')->group(
            function () {
                Route::get('/', 'Keywords\KeywordsController@index');
                Route::get('/actions', 'Keywords\KeywordsController@getActions');

                Route::get('{common_keywords}/tags ', 'Keywords\KeywordsController@tags');
                Route::post('{common_keywords}/tags ', 'Keywords\KeywordsController@saveTags');
                Route::get('{common_keywords}/addresses ', 'Keywords\KeywordsController@addresses');
                Route::post('{common_keywords}/addresses ', 'Keywords\KeywordsController@saveAddresses');

                Route::get('/{common_keywords}/{subObjects}', 'Keywords\KeywordsController@relatedObjects');
                Route::get('/{common_keywords}', 'Keywords\KeywordsController@show');

                Route::post('/', 'Keywords\KeywordsController@store');
                Route::post('/{common_keywords}/do/{action}', 'Keywords\KeywordsController@doAction');

                Route::patch('/{common_keywords}', 'Keywords\KeywordsController@update');
                Route::delete('/{common_keywords}', 'Keywords\KeywordsController@destroy');
            }
        );

        Route::prefix('disposable-emails')->group(
            function () {
                Route::get('/', 'DisposableEmails\DisposableEmailsController@index');
                Route::get('/actions', 'DisposableEmails\DisposableEmailsController@getActions');

                Route::get('{common_disposable_emails}/tags ', 'DisposableEmails\DisposableEmailsController@tags');
                Route::post('{common_disposable_emails}/tags ', 'DisposableEmails\DisposableEmailsController@saveTags');
                Route::get('{common_disposable_emails}/addresses ', 'DisposableEmails\DisposableEmailsController@addresses');
                Route::post('{common_disposable_emails}/addresses ', 'DisposableEmails\DisposableEmailsController@saveAddresses');

                Route::get('/{common_disposable_emails}/{subObjects}', 'DisposableEmails\DisposableEmailsController@relatedObjects');
                Route::get('/{common_disposable_emails}', 'DisposableEmails\DisposableEmailsController@show');

                Route::post('/', 'DisposableEmails\DisposableEmailsController@store');
                Route::post('/{common_disposable_emails}/do/{action}', 'DisposableEmails\DisposableEmailsController@doAction');

                Route::patch('/{common_disposable_emails}', 'DisposableEmails\DisposableEmailsController@update');
                Route::delete('/{common_disposable_emails}', 'DisposableEmails\DisposableEmailsController@destroy');
            }
        );

        Route::prefix('media')->group(
            function () {
                Route::get('/', 'Media\MediaController@index');
                Route::get('/actions', 'Media\MediaController@getActions');

                Route::get('{common_media}/tags ', 'Media\MediaController@tags');
                Route::post('{common_media}/tags ', 'Media\MediaController@saveTags');
                Route::get('{common_media}/addresses ', 'Media\MediaController@addresses');
                Route::post('{common_media}/addresses ', 'Media\MediaController@saveAddresses');

                Route::get('/{common_media}/{subObjects}', 'Media\MediaController@relatedObjects');
                Route::get('/{common_media}', 'Media\MediaController@show');

                Route::post('/', 'Media\MediaController@store');
                Route::post('/{common_media}/do/{action}', 'Media\MediaController@doAction');

                Route::patch('/{common_media}', 'Media\MediaController@update');
                Route::delete('/{common_media}', 'Media\MediaController@destroy');
            }
        );

        Route::prefix('comments')->group(
            function () {
                Route::get('/', 'Comments\CommentsController@index');
                Route::get('/actions', 'Comments\CommentsController@getActions');

                Route::get('{common_comments}/tags ', 'Comments\CommentsController@tags');
                Route::post('{common_comments}/tags ', 'Comments\CommentsController@saveTags');
                Route::get('{common_comments}/addresses ', 'Comments\CommentsController@addresses');
                Route::post('{common_comments}/addresses ', 'Comments\CommentsController@saveAddresses');

                Route::get('/{common_comments}/{subObjects}', 'Comments\CommentsController@relatedObjects');
                Route::get('/{common_comments}', 'Comments\CommentsController@show');

                Route::post('/', 'Comments\CommentsController@store');
                Route::post('/{common_comments}/do/{action}', 'Comments\CommentsController@doAction');

                Route::patch('/{common_comments}', 'Comments\CommentsController@update');
                Route::delete('/{common_comments}', 'Comments\CommentsController@destroy');
            }
        );

        Route::prefix('cities')->group(
            function () {
                Route::get('/', 'Cities\CitiesController@index');
                Route::get('/actions', 'Cities\CitiesController@getActions');

                Route::get('{common_cities}/tags ', 'Cities\CitiesController@tags');
                Route::post('{common_cities}/tags ', 'Cities\CitiesController@saveTags');
                Route::get('{common_cities}/addresses ', 'Cities\CitiesController@addresses');
                Route::post('{common_cities}/addresses ', 'Cities\CitiesController@saveAddresses');

                Route::get('/{common_cities}/{subObjects}', 'Cities\CitiesController@relatedObjects');
                Route::get('/{common_cities}', 'Cities\CitiesController@show');

                Route::post('/', 'Cities\CitiesController@store');
                Route::post('/{common_cities}/do/{action}', 'Cities\CitiesController@doAction');

                Route::patch('/{common_cities}', 'Cities\CitiesController@update');
                Route::delete('/{common_cities}', 'Cities\CitiesController@destroy');
            }
        );

        Route::prefix('meta')->group(
            function () {
                Route::get('/', 'Meta\MetaController@index');
                Route::get('/actions', 'Meta\MetaController@getActions');

                Route::get('{common_meta}/tags ', 'Meta\MetaController@tags');
                Route::post('{common_meta}/tags ', 'Meta\MetaController@saveTags');
                Route::get('{common_meta}/addresses ', 'Meta\MetaController@addresses');
                Route::post('{common_meta}/addresses ', 'Meta\MetaController@saveAddresses');

                Route::get('/{common_meta}/{subObjects}', 'Meta\MetaController@relatedObjects');
                Route::get('/{common_meta}', 'Meta\MetaController@show');

                Route::post('/', 'Meta\MetaController@store');
                Route::post('/{common_meta}/do/{action}', 'Meta\MetaController@doAction');

                Route::patch('/{common_meta}', 'Meta\MetaController@update');
                Route::delete('/{common_meta}', 'Meta\MetaController@destroy');
            }
        );

        Route::prefix('votes')->group(
            function () {
                Route::get('/', 'Votes\VotesController@index');
                Route::get('/actions', 'Votes\VotesController@getActions');

                Route::get('{common_votes}/tags ', 'Votes\VotesController@tags');
                Route::post('{common_votes}/tags ', 'Votes\VotesController@saveTags');
                Route::get('{common_votes}/addresses ', 'Votes\VotesController@addresses');
                Route::post('{common_votes}/addresses ', 'Votes\VotesController@saveAddresses');

                Route::get('/{common_votes}/{subObjects}', 'Votes\VotesController@relatedObjects');
                Route::get('/{common_votes}', 'Votes\VotesController@show');

                Route::post('/', 'Votes\VotesController@store');
                Route::post('/{common_votes}/do/{action}', 'Votes\VotesController@doAction');

                Route::patch('/{common_votes}', 'Votes\VotesController@update');
                Route::delete('/{common_votes}', 'Votes\VotesController@destroy');
            }
        );

        Route::prefix('registries')->group(
            function () {
                Route::get('/', 'Registries\RegistriesController@index');
                Route::get('/actions', 'Registries\RegistriesController@getActions');

                Route::get('{common_registries}/tags ', 'Registries\RegistriesController@tags');
                Route::post('{common_registries}/tags ', 'Registries\RegistriesController@saveTags');
                Route::get('{common_registries}/addresses ', 'Registries\RegistriesController@addresses');
                Route::post('{common_registries}/addresses ', 'Registries\RegistriesController@saveAddresses');

                Route::get('/{common_registries}/{subObjects}', 'Registries\RegistriesController@relatedObjects');
                Route::get('/{common_registries}', 'Registries\RegistriesController@show');

                Route::post('/', 'Registries\RegistriesController@store');
                Route::post('/{common_registries}/do/{action}', 'Registries\RegistriesController@doAction');

                Route::patch('/{common_registries}', 'Registries\RegistriesController@update');
                Route::delete('/{common_registries}', 'Registries\RegistriesController@destroy');
            }
        );

        Route::prefix('tags')->group(
            function () {
                Route::get('/', 'Tags\TagsController@index');
                Route::get('/actions', 'Tags\TagsController@getActions');

                Route::get('{common_tags}/tags ', 'Tags\TagsController@tags');
                Route::post('{common_tags}/tags ', 'Tags\TagsController@saveTags');
                Route::get('{common_tags}/addresses ', 'Tags\TagsController@addresses');
                Route::post('{common_tags}/addresses ', 'Tags\TagsController@saveAddresses');

                Route::get('/{common_tags}/{subObjects}', 'Tags\TagsController@relatedObjects');
                Route::get('/{common_tags}', 'Tags\TagsController@show');

                Route::post('/', 'Tags\TagsController@store');
                Route::post('/{common_tags}/do/{action}', 'Tags\TagsController@doAction');

                Route::patch('/{common_tags}', 'Tags\TagsController@update');
                Route::delete('/{common_tags}', 'Tags\TagsController@destroy');
            }
        );

        Route::prefix('social-media')->group(
            function () {
                Route::get('/', 'SocialMedia\SocialMediaController@index');
                Route::get('/actions', 'SocialMedia\SocialMediaController@getActions');

                Route::get('{common_social_media}/tags ', 'SocialMedia\SocialMediaController@tags');
                Route::post('{common_social_media}/tags ', 'SocialMedia\SocialMediaController@saveTags');
                Route::get('{common_social_media}/addresses ', 'SocialMedia\SocialMediaController@addresses');
                Route::post('{common_social_media}/addresses ', 'SocialMedia\SocialMediaController@saveAddresses');

                Route::get('/{common_social_media}/{subObjects}', 'SocialMedia\SocialMediaController@relatedObjects');
                Route::get('/{common_social_media}', 'SocialMedia\SocialMediaController@show');

                Route::post('/', 'SocialMedia\SocialMediaController@store');
                Route::post('/{common_social_media}/do/{action}', 'SocialMedia\SocialMediaController@doAction');

                Route::patch('/{common_social_media}', 'SocialMedia\SocialMediaController@update');
                Route::delete('/{common_social_media}', 'SocialMedia\SocialMediaController@destroy');
            }
        );

        Route::prefix('states')->group(
            function () {
                Route::get('/', 'States\StatesController@index');
                Route::get('/actions', 'States\StatesController@getActions');

                Route::get('{common_states}/tags ', 'States\StatesController@tags');
                Route::post('{common_states}/tags ', 'States\StatesController@saveTags');
                Route::get('{common_states}/addresses ', 'States\StatesController@addresses');
                Route::post('{common_states}/addresses ', 'States\StatesController@saveAddresses');

                Route::get('/{common_states}/{subObjects}', 'States\StatesController@relatedObjects');
                Route::get('/{common_states}', 'States\StatesController@show');

                Route::post('/', 'States\StatesController@store');
                Route::post('/{common_states}/do/{action}', 'States\StatesController@doAction');

                Route::patch('/{common_states}', 'States\StatesController@update');
                Route::delete('/{common_states}', 'States\StatesController@destroy');
            }
        );

        Route::prefix('validatable')->group(
            function () {
                Route::get('/', 'Validatable\ValidatableController@index');
                Route::get('/actions', 'Validatable\ValidatableController@getActions');

                Route::get('{common_validatable}/tags ', 'Validatable\ValidatableController@tags');
                Route::post('{common_validatable}/tags ', 'Validatable\ValidatableController@saveTags');
                Route::get('{common_validatable}/addresses ', 'Validatable\ValidatableController@addresses');
                Route::post('{common_validatable}/addresses ', 'Validatable\ValidatableController@saveAddresses');

                Route::get('/{common_validatable}/{subObjects}', 'Validatable\ValidatableController@relatedObjects');
                Route::get('/{common_validatable}', 'Validatable\ValidatableController@show');

                Route::post('/', 'Validatable\ValidatableController@store');
                Route::post('/{common_validatable}/do/{action}', 'Validatable\ValidatableController@doAction');

                Route::patch('/{common_validatable}', 'Validatable\ValidatableController@update');
                Route::delete('/{common_validatable}', 'Validatable\ValidatableController@destroy');
            }
        );

        Route::prefix('phone-numbers')->group(
            function () {
                Route::get('/', 'PhoneNumbers\PhoneNumbersController@index');
                Route::get('/actions', 'PhoneNumbers\PhoneNumbersController@getActions');

                Route::get('{common_phone_numbers}/tags ', 'PhoneNumbers\PhoneNumbersController@tags');
                Route::post('{common_phone_numbers}/tags ', 'PhoneNumbers\PhoneNumbersController@saveTags');
                Route::get('{common_phone_numbers}/addresses ', 'PhoneNumbers\PhoneNumbersController@addresses');
                Route::post('{common_phone_numbers}/addresses ', 'PhoneNumbers\PhoneNumbersController@saveAddresses');

                Route::get('/{common_phone_numbers}/{subObjects}', 'PhoneNumbers\PhoneNumbersController@relatedObjects');
                Route::get('/{common_phone_numbers}', 'PhoneNumbers\PhoneNumbersController@show');

                Route::post('/', 'PhoneNumbers\PhoneNumbersController@store');
                Route::post('/{common_phone_numbers}/do/{action}', 'PhoneNumbers\PhoneNumbersController@doAction');

                Route::patch('/{common_phone_numbers}', 'PhoneNumbers\PhoneNumbersController@update');
                Route::delete('/{common_phone_numbers}', 'PhoneNumbers\PhoneNumbersController@destroy');
            }
        );

        Route::prefix('task-schedulers')->group(
            function () {
                Route::get('/', 'TaskSchedulers\TaskSchedulersController@index');
                Route::get('/actions', 'TaskSchedulers\TaskSchedulersController@getActions');

                Route::get('{common_task_schedulers}/tags ', 'TaskSchedulers\TaskSchedulersController@tags');
                Route::post('{common_task_schedulers}/tags ', 'TaskSchedulers\TaskSchedulersController@saveTags');
                Route::get('{common_task_schedulers}/addresses ', 'TaskSchedulers\TaskSchedulersController@addresses');
                Route::post('{common_task_schedulers}/addresses ', 'TaskSchedulers\TaskSchedulersController@saveAddresses');

                Route::get('/{common_task_schedulers}/{subObjects}', 'TaskSchedulers\TaskSchedulersController@relatedObjects');
                Route::get('/{common_task_schedulers}', 'TaskSchedulers\TaskSchedulersController@show');

                Route::post('/', 'TaskSchedulers\TaskSchedulersController@store');
                Route::post('/{common_task_schedulers}/do/{action}', 'TaskSchedulers\TaskSchedulersController@doAction');

                Route::patch('/{common_task_schedulers}', 'TaskSchedulers\TaskSchedulersController@update');
                Route::delete('/{common_task_schedulers}', 'TaskSchedulers\TaskSchedulersController@destroy');
            }
        );

        Route::prefix('action-checkpoints')->group(
            function () {
                Route::get('/', 'ActionCheckpoints\ActionCheckpointsController@index');
                Route::get('/actions', 'ActionCheckpoints\ActionCheckpointsController@getActions');

                Route::get('{common_action_checkpoints}/tags ', 'ActionCheckpoints\ActionCheckpointsController@tags');
                Route::post('{common_action_checkpoints}/tags ', 'ActionCheckpoints\ActionCheckpointsController@saveTags');
                Route::get('{common_action_checkpoints}/addresses ', 'ActionCheckpoints\ActionCheckpointsController@addresses');
                Route::post('{common_action_checkpoints}/addresses ', 'ActionCheckpoints\ActionCheckpointsController@saveAddresses');

                Route::get('/{common_action_checkpoints}/{subObjects}', 'ActionCheckpoints\ActionCheckpointsController@relatedObjects');
                Route::get('/{common_action_checkpoints}', 'ActionCheckpoints\ActionCheckpointsController@show');

                Route::post('/', 'ActionCheckpoints\ActionCheckpointsController@store');
                Route::post('/{common_action_checkpoints}/do/{action}', 'ActionCheckpoints\ActionCheckpointsController@doAction');

                Route::patch('/{common_action_checkpoints}', 'ActionCheckpoints\ActionCheckpointsController@update');
                Route::delete('/{common_action_checkpoints}', 'ActionCheckpoints\ActionCheckpointsController@destroy');
            }
        );

        Route::prefix('actions-perspective')->group(
            function () {
                Route::get('/', 'ActionsPerspective\ActionsPerspectiveController@index');
                Route::get('/actions', 'ActionsPerspective\ActionsPerspectiveController@getActions');

                Route::get('{common_actions_perspective}/tags ', 'ActionsPerspective\ActionsPerspectiveController@tags');
                Route::post('{common_actions_perspective}/tags ', 'ActionsPerspective\ActionsPerspectiveController@saveTags');
                Route::get('{common_actions_perspective}/addresses ', 'ActionsPerspective\ActionsPerspectiveController@addresses');
                Route::post('{common_actions_perspective}/addresses ', 'ActionsPerspective\ActionsPerspectiveController@saveAddresses');

                Route::get('/{common_actions_perspective}/{subObjects}', 'ActionsPerspective\ActionsPerspectiveController@relatedObjects');
                Route::get('/{common_actions_perspective}', 'ActionsPerspective\ActionsPerspectiveController@show');

                Route::post('/', 'ActionsPerspective\ActionsPerspectiveController@store');
                Route::post('/{common_actions_perspective}/do/{action}', 'ActionsPerspective\ActionsPerspectiveController@doAction');

                Route::patch('/{common_actions_perspective}', 'ActionsPerspective\ActionsPerspectiveController@update');
                Route::delete('/{common_actions_perspective}', 'ActionsPerspective\ActionsPerspectiveController@destroy');
            }
        );

        Route::prefix('scheduled-tasks')->group(
            function () {
                Route::get('/', 'ScheduledTasks\ScheduledTasksController@index');
                Route::get('/actions', 'ScheduledTasks\ScheduledTasksController@getActions');

                Route::get('{common_scheduled_tasks}/tags ', 'ScheduledTasks\ScheduledTasksController@tags');
                Route::post('{common_scheduled_tasks}/tags ', 'ScheduledTasks\ScheduledTasksController@saveTags');
                Route::get('{common_scheduled_tasks}/addresses ', 'ScheduledTasks\ScheduledTasksController@addresses');
                Route::post('{common_scheduled_tasks}/addresses ', 'ScheduledTasks\ScheduledTasksController@saveAddresses');

                Route::get('/{common_scheduled_tasks}/{subObjects}', 'ScheduledTasks\ScheduledTasksController@relatedObjects');
                Route::get('/{common_scheduled_tasks}', 'ScheduledTasks\ScheduledTasksController@show');

                Route::post('/', 'ScheduledTasks\ScheduledTasksController@store');
                Route::post('/{common_scheduled_tasks}/do/{action}', 'ScheduledTasks\ScheduledTasksController@doAction');

                Route::patch('/{common_scheduled_tasks}', 'ScheduledTasks\ScheduledTasksController@update');
                Route::delete('/{common_scheduled_tasks}', 'ScheduledTasks\ScheduledTasksController@destroy');
            }
        );

        // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE


























































        Route::post('/media/upload', 'Media\FileUploadController@upload');

        Route::get('/tags/object', 'Taggables\ObjectTagsController@index');
        Route::post('/tags/object', 'Taggables\ObjectTagsController@store');

        Route::get('/storage/uploads/{file}', [\NextDeveloper\Commons\Http\Controllers\Media\FileUploadController::class, 'show']);

        Route::prefix('available-external-services')->group(
            function () {
                Route::get('/', 'ExternalServices\ExternalServicesController@getAvailableServices');
            }
        );
    }
);






