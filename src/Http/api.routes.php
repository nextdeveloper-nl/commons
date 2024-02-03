<?php

Route::prefix('commons')->group(
    function () {
        Route::prefix('action-logs')->group(
            function () {
                Route::get('/', 'ActionLogs\ActionLogsController@index');

                Route::get('{common_action_logs}/tags ', 'ActionLogs\ActionLogsController@tags');
                Route::post('{common_action_logs}/tags ', 'ActionLogs\ActionLogsController@saveTags');
                Route::get('{common_action_logs}/addresses ', 'ActionLogs\ActionLogsController@addresses');
                Route::post('{common_action_logs}/addresses ', 'ActionLogs\ActionLogsController@saveAddresses');

                Route::get('/{common_action_logs}/{subObjects}', 'ActionLogs\ActionLogsController@relatedObjects');
                Route::get('/{common_action_logs}', 'ActionLogs\ActionLogsController@show');

                Route::post('/', 'ActionLogs\ActionLogsController@store');
                Route::patch('/{common_action_logs}', 'ActionLogs\ActionLogsController@update');
                Route::delete('/{common_action_logs}', 'ActionLogs\ActionLogsController@destroy');
            }
        );

        Route::prefix('actions')->group(
            function () {
                Route::get('/', 'Actions\ActionsController@index');

                Route::get('{common_actions}/tags ', 'Actions\ActionsController@tags');
                Route::post('{common_actions}/tags ', 'Actions\ActionsController@saveTags');
                Route::get('{common_actions}/addresses ', 'Actions\ActionsController@addresses');
                Route::post('{common_actions}/addresses ', 'Actions\ActionsController@saveAddresses');

                Route::get('/{common_actions}/{subObjects}', 'Actions\ActionsController@relatedObjects');
                Route::get('/{common_actions}', 'Actions\ActionsController@show');

                Route::post('/', 'Actions\ActionsController@store');
                Route::patch('/{common_actions}', 'Actions\ActionsController@update');
                Route::delete('/{common_actions}', 'Actions\ActionsController@destroy');
            }
        );

        Route::prefix('addresses')->group(
            function () {
                Route::get('/', 'Addresses\AddressesController@index');

                Route::get('{common_addresses}/tags ', 'Addresses\AddressesController@tags');
                Route::post('{common_addresses}/tags ', 'Addresses\AddressesController@saveTags');
                Route::get('{common_addresses}/addresses ', 'Addresses\AddressesController@addresses');
                Route::post('{common_addresses}/addresses ', 'Addresses\AddressesController@saveAddresses');

                Route::get('/{common_addresses}/{subObjects}', 'Addresses\AddressesController@relatedObjects');
                Route::get('/{common_addresses}', 'Addresses\AddressesController@show');

                Route::post('/', 'Addresses\AddressesController@store');
                Route::patch('/{common_addresses}', 'Addresses\AddressesController@update');
                Route::delete('/{common_addresses}', 'Addresses\AddressesController@destroy');
            }
        );

        Route::prefix('categories')->group(
            function () {
                Route::get('/', 'Categories\CategoriesController@index');

                Route::get('{common_categories}/tags ', 'Categories\CategoriesController@tags');
                Route::post('{common_categories}/tags ', 'Categories\CategoriesController@saveTags');
                Route::get('{common_categories}/addresses ', 'Categories\CategoriesController@addresses');
                Route::post('{common_categories}/addresses ', 'Categories\CategoriesController@saveAddresses');

                Route::get('/{common_categories}/{subObjects}', 'Categories\CategoriesController@relatedObjects');
                Route::get('/{common_categories}', 'Categories\CategoriesController@show');

                Route::post('/', 'Categories\CategoriesController@store');
                Route::patch('/{common_categories}', 'Categories\CategoriesController@update');
                Route::delete('/{common_categories}', 'Categories\CategoriesController@destroy');
            }
        );

        Route::prefix('comments')->group(
            function () {
                Route::get('/', 'Comments\CommentsController@index');

                Route::get('{common_comments}/tags ', 'Comments\CommentsController@tags');
                Route::post('{common_comments}/tags ', 'Comments\CommentsController@saveTags');
                Route::get('{common_comments}/addresses ', 'Comments\CommentsController@addresses');
                Route::post('{common_comments}/addresses ', 'Comments\CommentsController@saveAddresses');

                Route::get('/{common_comments}/{subObjects}', 'Comments\CommentsController@relatedObjects');
                Route::get('/{common_comments}', 'Comments\CommentsController@show');

                Route::post('/', 'Comments\CommentsController@store');
                Route::patch('/{common_comments}', 'Comments\CommentsController@update');
                Route::delete('/{common_comments}', 'Comments\CommentsController@destroy');
            }
        );

        Route::prefix('countries')->group(
            function () {
                Route::get('/', 'Countries\CountriesController@index');

                Route::get('{common_countries}/tags ', 'Countries\CountriesController@tags');
                Route::post('{common_countries}/tags ', 'Countries\CountriesController@saveTags');
                Route::get('{common_countries}/addresses ', 'Countries\CountriesController@addresses');
                Route::post('{common_countries}/addresses ', 'Countries\CountriesController@saveAddresses');

                Route::get('/{common_countries}/{subObjects}', 'Countries\CountriesController@relatedObjects');
                Route::get('/{common_countries}', 'Countries\CountriesController@show');

                Route::post('/', 'Countries\CountriesController@store');
                Route::patch('/{common_countries}', 'Countries\CountriesController@update');
                Route::delete('/{common_countries}', 'Countries\CountriesController@destroy');
            }
        );

        Route::prefix('currencies')->group(
            function () {
                Route::get('/', 'Currencies\CurrenciesController@index');

                Route::get('{common_currencies}/tags ', 'Currencies\CurrenciesController@tags');
                Route::post('{common_currencies}/tags ', 'Currencies\CurrenciesController@saveTags');
                Route::get('{common_currencies}/addresses ', 'Currencies\CurrenciesController@addresses');
                Route::post('{common_currencies}/addresses ', 'Currencies\CurrenciesController@saveAddresses');

                Route::get('/{common_currencies}/{subObjects}', 'Currencies\CurrenciesController@relatedObjects');
                Route::get('/{common_currencies}', 'Currencies\CurrenciesController@show');

                Route::post('/', 'Currencies\CurrenciesController@store');
                Route::patch('/{common_currencies}', 'Currencies\CurrenciesController@update');
                Route::delete('/{common_currencies}', 'Currencies\CurrenciesController@destroy');
            }
        );

        Route::prefix('disposable-emails')->group(
            function () {
                Route::get('/', 'DisposableEmails\DisposableEmailsController@index');

                Route::get('{common_disposable_emails}/tags ', 'DisposableEmails\DisposableEmailsController@tags');
                Route::post('{common_disposable_emails}/tags ', 'DisposableEmails\DisposableEmailsController@saveTags');
                Route::get('{common_disposable_emails}/addresses ', 'DisposableEmails\DisposableEmailsController@addresses');
                Route::post('{common_disposable_emails}/addresses ', 'DisposableEmails\DisposableEmailsController@saveAddresses');

                Route::get('/{common_disposable_emails}/{subObjects}', 'DisposableEmails\DisposableEmailsController@relatedObjects');
                Route::get('/{common_disposable_emails}', 'DisposableEmails\DisposableEmailsController@show');

                Route::post('/', 'DisposableEmails\DisposableEmailsController@store');
                Route::patch('/{common_disposable_emails}', 'DisposableEmails\DisposableEmailsController@update');
                Route::delete('/{common_disposable_emails}', 'DisposableEmails\DisposableEmailsController@destroy');
            }
        );

        Route::prefix('domainables')->group(
            function () {
                Route::get('/', 'Domainables\DomainablesController@index');

                Route::get('{common_domainables}/tags ', 'Domainables\DomainablesController@tags');
                Route::post('{common_domainables}/tags ', 'Domainables\DomainablesController@saveTags');
                Route::get('{common_domainables}/addresses ', 'Domainables\DomainablesController@addresses');
                Route::post('{common_domainables}/addresses ', 'Domainables\DomainablesController@saveAddresses');

                Route::get('/{common_domainables}/{subObjects}', 'Domainables\DomainablesController@relatedObjects');
                Route::get('/{common_domainables}', 'Domainables\DomainablesController@show');

                Route::post('/', 'Domainables\DomainablesController@store');
                Route::patch('/{common_domainables}', 'Domainables\DomainablesController@update');
                Route::delete('/{common_domainables}', 'Domainables\DomainablesController@destroy');
            }
        );

        Route::prefix('domains')->group(
            function () {
                Route::get('/', 'Domains\DomainsController@index');

                Route::get('{common_domains}/tags ', 'Domains\DomainsController@tags');
                Route::post('{common_domains}/tags ', 'Domains\DomainsController@saveTags');
                Route::get('{common_domains}/addresses ', 'Domains\DomainsController@addresses');
                Route::post('{common_domains}/addresses ', 'Domains\DomainsController@saveAddresses');

                Route::get('/{common_domains}/{subObjects}', 'Domains\DomainsController@relatedObjects');
                Route::get('/{common_domains}', 'Domains\DomainsController@show');

                Route::post('/', 'Domains\DomainsController@store');
                Route::patch('/{common_domains}', 'Domains\DomainsController@update');
                Route::delete('/{common_domains}', 'Domains\DomainsController@destroy');
            }
        );

        Route::prefix('exchange-rates')->group(
            function () {
                Route::get('/', 'ExchangeRates\ExchangeRatesController@index');

                Route::get('{common_exchange_rates}/tags ', 'ExchangeRates\ExchangeRatesController@tags');
                Route::post('{common_exchange_rates}/tags ', 'ExchangeRates\ExchangeRatesController@saveTags');
                Route::get('{common_exchange_rates}/addresses ', 'ExchangeRates\ExchangeRatesController@addresses');
                Route::post('{common_exchange_rates}/addresses ', 'ExchangeRates\ExchangeRatesController@saveAddresses');

                Route::get('/{common_exchange_rates}/{subObjects}', 'ExchangeRates\ExchangeRatesController@relatedObjects');
                Route::get('/{common_exchange_rates}', 'ExchangeRates\ExchangeRatesController@show');

                Route::post('/', 'ExchangeRates\ExchangeRatesController@store');
                Route::patch('/{common_exchange_rates}', 'ExchangeRates\ExchangeRatesController@update');
                Route::delete('/{common_exchange_rates}', 'ExchangeRates\ExchangeRatesController@destroy');
            }
        );

        Route::prefix('languages')->group(
            function () {
                Route::get('/', 'Languages\LanguagesController@index');

                Route::get('{common_languages}/tags ', 'Languages\LanguagesController@tags');
                Route::post('{common_languages}/tags ', 'Languages\LanguagesController@saveTags');
                Route::get('{common_languages}/addresses ', 'Languages\LanguagesController@addresses');
                Route::post('{common_languages}/addresses ', 'Languages\LanguagesController@saveAddresses');

                Route::get('/{common_languages}/{subObjects}', 'Languages\LanguagesController@relatedObjects');
                Route::get('/{common_languages}', 'Languages\LanguagesController@show');

                Route::post('/', 'Languages\LanguagesController@store');
                Route::patch('/{common_languages}', 'Languages\LanguagesController@update');
                Route::delete('/{common_languages}', 'Languages\LanguagesController@destroy');
            }
        );

        Route::prefix('media')->group(
            function () {
                Route::get('/', 'Media\MediaController@index');

                Route::get('{common_media}/tags ', 'Media\MediaController@tags');
                Route::post('{common_media}/tags ', 'Media\MediaController@saveTags');
                Route::get('{common_media}/addresses ', 'Media\MediaController@addresses');
                Route::post('{common_media}/addresses ', 'Media\MediaController@saveAddresses');

                Route::get('/{common_media}/{subObjects}', 'Media\MediaController@relatedObjects');
                Route::get('/{common_media}', 'Media\MediaController@show');

                Route::post('/', 'Media\MediaController@store');
                Route::patch('/{common_media}', 'Media\MediaController@update');
                Route::delete('/{common_media}', 'Media\MediaController@destroy');
            }
        );

        Route::prefix('meta')->group(
            function () {
                Route::get('/', 'Meta\MetaController@index');

                Route::get('{common_meta}/tags ', 'Meta\MetaController@tags');
                Route::post('{common_meta}/tags ', 'Meta\MetaController@saveTags');
                Route::get('{common_meta}/addresses ', 'Meta\MetaController@addresses');
                Route::post('{common_meta}/addresses ', 'Meta\MetaController@saveAddresses');

                Route::get('/{common_meta}/{subObjects}', 'Meta\MetaController@relatedObjects');
                Route::get('/{common_meta}', 'Meta\MetaController@show');

                Route::post('/', 'Meta\MetaController@store');
                Route::patch('/{common_meta}', 'Meta\MetaController@update');
                Route::delete('/{common_meta}', 'Meta\MetaController@destroy');
            }
        );

        Route::prefix('phone-numbers')->group(
            function () {
                Route::get('/', 'PhoneNumbers\PhoneNumbersController@index');

                Route::get('{common_phone_numbers}/tags ', 'PhoneNumbers\PhoneNumbersController@tags');
                Route::post('{common_phone_numbers}/tags ', 'PhoneNumbers\PhoneNumbersController@saveTags');
                Route::get('{common_phone_numbers}/addresses ', 'PhoneNumbers\PhoneNumbersController@addresses');
                Route::post('{common_phone_numbers}/addresses ', 'PhoneNumbers\PhoneNumbersController@saveAddresses');

                Route::get('/{common_phone_numbers}/{subObjects}', 'PhoneNumbers\PhoneNumbersController@relatedObjects');
                Route::get('/{common_phone_numbers}', 'PhoneNumbers\PhoneNumbersController@show');

                Route::post('/', 'PhoneNumbers\PhoneNumbersController@store');
                Route::patch('/{common_phone_numbers}', 'PhoneNumbers\PhoneNumbersController@update');
                Route::delete('/{common_phone_numbers}', 'PhoneNumbers\PhoneNumbersController@destroy');
            }
        );

        Route::prefix('registries')->group(
            function () {
                Route::get('/', 'Registries\RegistriesController@index');

                Route::get('{common_registries}/tags ', 'Registries\RegistriesController@tags');
                Route::post('{common_registries}/tags ', 'Registries\RegistriesController@saveTags');
                Route::get('{common_registries}/addresses ', 'Registries\RegistriesController@addresses');
                Route::post('{common_registries}/addresses ', 'Registries\RegistriesController@saveAddresses');

                Route::get('/{common_registries}/{subObjects}', 'Registries\RegistriesController@relatedObjects');
                Route::get('/{common_registries}', 'Registries\RegistriesController@show');

                Route::post('/', 'Registries\RegistriesController@store');
                Route::patch('/{common_registries}', 'Registries\RegistriesController@update');
                Route::delete('/{common_registries}', 'Registries\RegistriesController@destroy');
            }
        );

        Route::prefix('social-media')->group(
            function () {
                Route::get('/', 'SocialMedia\SocialMediaController@index');

                Route::get('{common_social_media}/tags ', 'SocialMedia\SocialMediaController@tags');
                Route::post('{common_social_media}/tags ', 'SocialMedia\SocialMediaController@saveTags');
                Route::get('{common_social_media}/addresses ', 'SocialMedia\SocialMediaController@addresses');
                Route::post('{common_social_media}/addresses ', 'SocialMedia\SocialMediaController@saveAddresses');

                Route::get('/{common_social_media}/{subObjects}', 'SocialMedia\SocialMediaController@relatedObjects');
                Route::get('/{common_social_media}', 'SocialMedia\SocialMediaController@show');

                Route::post('/', 'SocialMedia\SocialMediaController@store');
                Route::patch('/{common_social_media}', 'SocialMedia\SocialMediaController@update');
                Route::delete('/{common_social_media}', 'SocialMedia\SocialMediaController@destroy');
            }
        );

        Route::prefix('states')->group(
            function () {
                Route::get('/', 'States\StatesController@index');

                Route::get('{common_states}/tags ', 'States\StatesController@tags');
                Route::post('{common_states}/tags ', 'States\StatesController@saveTags');
                Route::get('{common_states}/addresses ', 'States\StatesController@addresses');
                Route::post('{common_states}/addresses ', 'States\StatesController@saveAddresses');

                Route::get('/{common_states}/{subObjects}', 'States\StatesController@relatedObjects');
                Route::get('/{common_states}', 'States\StatesController@show');

                Route::post('/', 'States\StatesController@store');
                Route::patch('/{common_states}', 'States\StatesController@update');
                Route::delete('/{common_states}', 'States\StatesController@destroy');
            }
        );

        Route::prefix('taggables')->group(
            function () {
                Route::get('/', 'Taggables\TaggablesController@index');

                Route::get('{common_taggables}/tags ', 'Taggables\TaggablesController@tags');
                Route::post('{common_taggables}/tags ', 'Taggables\TaggablesController@saveTags');
                Route::get('{common_taggables}/addresses ', 'Taggables\TaggablesController@addresses');
                Route::post('{common_taggables}/addresses ', 'Taggables\TaggablesController@saveAddresses');

                Route::get('/{common_taggables}/{subObjects}', 'Taggables\TaggablesController@relatedObjects');
                Route::get('/{common_taggables}', 'Taggables\TaggablesController@show');

                Route::post('/', 'Taggables\TaggablesController@store');
                Route::patch('/{common_taggables}', 'Taggables\TaggablesController@update');
                Route::delete('/{common_taggables}', 'Taggables\TaggablesController@destroy');
            }
        );

        Route::prefix('tags')->group(
            function () {
                Route::get('/', 'Tags\TagsController@index');

                Route::get('{common_tags}/tags ', 'Tags\TagsController@tags');
                Route::post('{common_tags}/tags ', 'Tags\TagsController@saveTags');
                Route::get('{common_tags}/addresses ', 'Tags\TagsController@addresses');
                Route::post('{common_tags}/addresses ', 'Tags\TagsController@saveAddresses');

                Route::get('/{common_tags}/{subObjects}', 'Tags\TagsController@relatedObjects');
                Route::get('/{common_tags}', 'Tags\TagsController@show');

                Route::post('/', 'Tags\TagsController@store');
                Route::patch('/{common_tags}', 'Tags\TagsController@update');
                Route::delete('/{common_tags}', 'Tags\TagsController@destroy');
            }
        );

        Route::prefix('validatable')->group(
            function () {
                Route::get('/', 'Validatable\ValidatableController@index');

                Route::get('{common_validatable}/tags ', 'Validatable\ValidatableController@tags');
                Route::post('{common_validatable}/tags ', 'Validatable\ValidatableController@saveTags');
                Route::get('{common_validatable}/addresses ', 'Validatable\ValidatableController@addresses');
                Route::post('{common_validatable}/addresses ', 'Validatable\ValidatableController@saveAddresses');

                Route::get('/{common_validatable}/{subObjects}', 'Validatable\ValidatableController@relatedObjects');
                Route::get('/{common_validatable}', 'Validatable\ValidatableController@show');

                Route::post('/', 'Validatable\ValidatableController@store');
                Route::patch('/{common_validatable}', 'Validatable\ValidatableController@update');
                Route::delete('/{common_validatable}', 'Validatable\ValidatableController@destroy');
            }
        );

        Route::prefix('votes')->group(
            function () {
                Route::get('/', 'Votes\VotesController@index');

                Route::get('{common_votes}/tags ', 'Votes\VotesController@tags');
                Route::post('{common_votes}/tags ', 'Votes\VotesController@saveTags');
                Route::get('{common_votes}/addresses ', 'Votes\VotesController@addresses');
                Route::post('{common_votes}/addresses ', 'Votes\VotesController@saveAddresses');

                Route::get('/{common_votes}/{subObjects}', 'Votes\VotesController@relatedObjects');
                Route::get('/{common_votes}', 'Votes\VotesController@show');

                Route::post('/', 'Votes\VotesController@store');
                Route::patch('/{common_votes}', 'Votes\VotesController@update');
                Route::delete('/{common_votes}', 'Votes\VotesController@destroy');
            }
        );

        Route::prefix('view-tags')->group(
            function () {
                Route::get('/', 'ViewTags\ViewTagsController@index');

                Route::get('{common_view_tags}/tags ', 'ViewTags\ViewTagsController@tags');
                Route::post('{common_view_tags}/tags ', 'ViewTags\ViewTagsController@saveTags');
                Route::get('{common_view_tags}/addresses ', 'ViewTags\ViewTagsController@addresses');
                Route::post('{common_view_tags}/addresses ', 'ViewTags\ViewTagsController@saveAddresses');

                Route::get('/{common_view_tags}/{subObjects}', 'ViewTags\ViewTagsController@relatedObjects');
                Route::get('/{common_view_tags}', 'ViewTags\ViewTagsController@show');

                Route::post('/', 'ViewTags\ViewTagsController@store');
                Route::patch('/{common_view_tags}', 'ViewTags\ViewTagsController@update');
                Route::delete('/{common_view_tags}', 'ViewTags\ViewTagsController@destroy');
            }
        );

        Route::prefix('view-tags')->group(
            function () {
                Route::get('/', 'ViewTags\ViewTagsController@index');

                Route::get('{common_view_tags}/tags ', 'ViewTags\ViewTagsController@tags');
                Route::post('{common_view_tags}/tags ', 'ViewTags\ViewTagsController@saveTags');
                Route::get('{common_view_tags}/addresses ', 'ViewTags\ViewTagsController@addresses');
                Route::post('{common_view_tags}/addresses ', 'ViewTags\ViewTagsController@saveAddresses');

                Route::get('/{common_view_tags}/{subObjects}', 'ViewTags\ViewTagsController@relatedObjects');
                Route::get('/{common_view_tags}', 'ViewTags\ViewTagsController@show');

                Route::post('/', 'ViewTags\ViewTagsController@store');
                Route::patch('/{common_view_tags}', 'ViewTags\ViewTagsController@update');
                Route::delete('/{common_view_tags}', 'ViewTags\ViewTagsController@destroy');
            }
        );

        Route::prefix('view-tags')->group(
            function () {
                Route::get('/', 'ViewTags\ViewTagsController@index');

                Route::get('{common_view_tags}/tags ', 'ViewTags\ViewTagsController@tags');
                Route::post('{common_view_tags}/tags ', 'ViewTags\ViewTagsController@saveTags');
                Route::get('{common_view_tags}/addresses ', 'ViewTags\ViewTagsController@addresses');
                Route::post('{common_view_tags}/addresses ', 'ViewTags\ViewTagsController@saveAddresses');

                Route::get('/{common_view_tags}/{subObjects}', 'ViewTags\ViewTagsController@relatedObjects');
                Route::get('/{common_view_tags}', 'ViewTags\ViewTagsController@show');

                Route::post('/', 'ViewTags\ViewTagsController@store');
                Route::patch('/{common_view_tags}', 'ViewTags\ViewTagsController@update');
                Route::delete('/{common_view_tags}', 'ViewTags\ViewTagsController@destroy');
            }
        );

        Route::prefix('view-tags')->group(
            function () {
                Route::get('/', 'ViewTags\ViewTagsController@index');

                Route::get('{common_view_tags}/tags ', 'ViewTags\ViewTagsController@tags');
                Route::post('{common_view_tags}/tags ', 'ViewTags\ViewTagsController@saveTags');
                Route::get('{common_view_tags}/addresses ', 'ViewTags\ViewTagsController@addresses');
                Route::post('{common_view_tags}/addresses ', 'ViewTags\ViewTagsController@saveAddresses');

                Route::get('/{common_view_tags}/{subObjects}', 'ViewTags\ViewTagsController@relatedObjects');
                Route::get('/{common_view_tags}', 'ViewTags\ViewTagsController@show');

                Route::post('/', 'ViewTags\ViewTagsController@store');
                Route::patch('/{common_view_tags}', 'ViewTags\ViewTagsController@update');
                Route::delete('/{common_view_tags}', 'ViewTags\ViewTagsController@destroy');
            }
        );

        Route::prefix('view-tags')->group(
            function () {
                Route::get('/', 'ViewTags\ViewTagsController@index');

                Route::get('{common_view_tags}/tags ', 'ViewTags\ViewTagsController@tags');
                Route::post('{common_view_tags}/tags ', 'ViewTags\ViewTagsController@saveTags');
                Route::get('{common_view_tags}/addresses ', 'ViewTags\ViewTagsController@addresses');
                Route::post('{common_view_tags}/addresses ', 'ViewTags\ViewTagsController@saveAddresses');

                Route::get('/{common_view_tags}/{subObjects}', 'ViewTags\ViewTagsController@relatedObjects');
                Route::get('/{common_view_tags}', 'ViewTags\ViewTagsController@show');

                Route::post('/', 'ViewTags\ViewTagsController@store');
                Route::patch('/{common_view_tags}', 'ViewTags\ViewTagsController@update');
                Route::delete('/{common_view_tags}', 'ViewTags\ViewTagsController@destroy');
            }
        );

        Route::prefix('country-states')->group(
            function () {
                Route::get('/', 'CountryStates\CountryStatesController@index');

                Route::get('{common_country_states}/tags ', 'CountryStates\CountryStatesController@tags');
                Route::post('{common_country_states}/tags ', 'CountryStates\CountryStatesController@saveTags');
                Route::get('{common_country_states}/addresses ', 'CountryStates\CountryStatesController@addresses');
                Route::post('{common_country_states}/addresses ', 'CountryStates\CountryStatesController@saveAddresses');

                Route::get('/{common_country_states}/{subObjects}', 'CountryStates\CountryStatesController@relatedObjects');
                Route::get('/{common_country_states}', 'CountryStates\CountryStatesController@show');

                Route::post('/', 'CountryStates\CountryStatesController@store');
                Route::patch('/{common_country_states}', 'CountryStates\CountryStatesController@update');
                Route::delete('/{common_country_states}', 'CountryStates\CountryStatesController@destroy');
            }
        );

        Route::prefix('exchange-rates')->group(
            function () {
                Route::get('/', 'ExchangeRates\ExchangeRatesController@index');

                Route::get('{common_exchange_rates}/tags ', 'ExchangeRates\ExchangeRatesController@tags');
                Route::post('{common_exchange_rates}/tags ', 'ExchangeRates\ExchangeRatesController@saveTags');
                Route::get('{common_exchange_rates}/addresses ', 'ExchangeRates\ExchangeRatesController@addresses');
                Route::post('{common_exchange_rates}/addresses ', 'ExchangeRates\ExchangeRatesController@saveAddresses');

                Route::get('/{common_exchange_rates}/{subObjects}', 'ExchangeRates\ExchangeRatesController@relatedObjects');
                Route::get('/{common_exchange_rates}', 'ExchangeRates\ExchangeRatesController@show');

                Route::post('/', 'ExchangeRates\ExchangeRatesController@store');
                Route::patch('/{common_exchange_rates}', 'ExchangeRates\ExchangeRatesController@update');
                Route::delete('/{common_exchange_rates}', 'ExchangeRates\ExchangeRatesController@destroy');
            }
        );

        Route::prefix('languages')->group(
            function () {
                Route::get('/', 'Languages\LanguagesController@index');

                Route::get('{common_languages}/tags ', 'Languages\LanguagesController@tags');
                Route::post('{common_languages}/tags ', 'Languages\LanguagesController@saveTags');
                Route::get('{common_languages}/addresses ', 'Languages\LanguagesController@addresses');
                Route::post('{common_languages}/addresses ', 'Languages\LanguagesController@saveAddresses');

                Route::get('/{common_languages}/{subObjects}', 'Languages\LanguagesController@relatedObjects');
                Route::get('/{common_languages}', 'Languages\LanguagesController@show');

                Route::post('/', 'Languages\LanguagesController@store');
                Route::patch('/{common_languages}', 'Languages\LanguagesController@update');
                Route::delete('/{common_languages}', 'Languages\LanguagesController@destroy');
            }
        );

        Route::prefix('media')->group(
            function () {
                Route::get('/', 'Media\MediaController@index');

                Route::get('{common_media}/tags ', 'Media\MediaController@tags');
                Route::post('{common_media}/tags ', 'Media\MediaController@saveTags');
                Route::get('{common_media}/addresses ', 'Media\MediaController@addresses');
                Route::post('{common_media}/addresses ', 'Media\MediaController@saveAddresses');

                Route::get('/{common_media}/{subObjects}', 'Media\MediaController@relatedObjects');
                Route::get('/{common_media}', 'Media\MediaController@show');

                Route::post('/', 'Media\MediaController@store');
                Route::patch('/{common_media}', 'Media\MediaController@update');
                Route::delete('/{common_media}', 'Media\MediaController@destroy');
            }
        );

        Route::prefix('meta')->group(
            function () {
                Route::get('/', 'Meta\MetaController@index');

                Route::get('{common_meta}/tags ', 'Meta\MetaController@tags');
                Route::post('{common_meta}/tags ', 'Meta\MetaController@saveTags');
                Route::get('{common_meta}/addresses ', 'Meta\MetaController@addresses');
                Route::post('{common_meta}/addresses ', 'Meta\MetaController@saveAddresses');

                Route::get('/{common_meta}/{subObjects}', 'Meta\MetaController@relatedObjects');
                Route::get('/{common_meta}', 'Meta\MetaController@show');

                Route::post('/', 'Meta\MetaController@store');
                Route::patch('/{common_meta}', 'Meta\MetaController@update');
                Route::delete('/{common_meta}', 'Meta\MetaController@destroy');
            }
        );

        Route::prefix('registries')->group(
            function () {
                Route::get('/', 'Registries\RegistriesController@index');

                Route::get('{common_registries}/tags ', 'Registries\RegistriesController@tags');
                Route::post('{common_registries}/tags ', 'Registries\RegistriesController@saveTags');
                Route::get('{common_registries}/addresses ', 'Registries\RegistriesController@addresses');
                Route::post('{common_registries}/addresses ', 'Registries\RegistriesController@saveAddresses');

                Route::get('/{common_registries}/{subObjects}', 'Registries\RegistriesController@relatedObjects');
                Route::get('/{common_registries}', 'Registries\RegistriesController@show');

                Route::post('/', 'Registries\RegistriesController@store');
                Route::patch('/{common_registries}', 'Registries\RegistriesController@update');
                Route::delete('/{common_registries}', 'Registries\RegistriesController@destroy');
            }
        );

        Route::prefix('social-media')->group(
            function () {
                Route::get('/', 'SocialMedia\SocialMediaController@index');

                Route::get('{common_social_media}/tags ', 'SocialMedia\SocialMediaController@tags');
                Route::post('{common_social_media}/tags ', 'SocialMedia\SocialMediaController@saveTags');
                Route::get('{common_social_media}/addresses ', 'SocialMedia\SocialMediaController@addresses');
                Route::post('{common_social_media}/addresses ', 'SocialMedia\SocialMediaController@saveAddresses');

                Route::get('/{common_social_media}/{subObjects}', 'SocialMedia\SocialMediaController@relatedObjects');
                Route::get('/{common_social_media}', 'SocialMedia\SocialMediaController@show');

                Route::post('/', 'SocialMedia\SocialMediaController@store');
                Route::patch('/{common_social_media}', 'SocialMedia\SocialMediaController@update');
                Route::delete('/{common_social_media}', 'SocialMedia\SocialMediaController@destroy');
            }
        );

        Route::prefix('states')->group(
            function () {
                Route::get('/', 'States\StatesController@index');

                Route::get('{common_states}/tags ', 'States\StatesController@tags');
                Route::post('{common_states}/tags ', 'States\StatesController@saveTags');
                Route::get('{common_states}/addresses ', 'States\StatesController@addresses');
                Route::post('{common_states}/addresses ', 'States\StatesController@saveAddresses');

                Route::get('/{common_states}/{subObjects}', 'States\StatesController@relatedObjects');
                Route::get('/{common_states}', 'States\StatesController@show');

                Route::post('/', 'States\StatesController@store');
                Route::patch('/{common_states}', 'States\StatesController@update');
                Route::delete('/{common_states}', 'States\StatesController@destroy');
            }
        );

        Route::prefix('tags')->group(
            function () {
                Route::get('/', 'Tags\TagsController@index');

                Route::get('{common_tags}/tags ', 'Tags\TagsController@tags');
                Route::post('{common_tags}/tags ', 'Tags\TagsController@saveTags');
                Route::get('{common_tags}/addresses ', 'Tags\TagsController@addresses');
                Route::post('{common_tags}/addresses ', 'Tags\TagsController@saveAddresses');

                Route::get('/{common_tags}/{subObjects}', 'Tags\TagsController@relatedObjects');
                Route::get('/{common_tags}', 'Tags\TagsController@show');

                Route::post('/', 'Tags\TagsController@store');
                Route::patch('/{common_tags}', 'Tags\TagsController@update');
                Route::delete('/{common_tags}', 'Tags\TagsController@destroy');
            }
        );

        Route::prefix('validatable')->group(
            function () {
                Route::get('/', 'Validatable\ValidatableController@index');

                Route::get('{common_validatable}/tags ', 'Validatable\ValidatableController@tags');
                Route::post('{common_validatable}/tags ', 'Validatable\ValidatableController@saveTags');
                Route::get('{common_validatable}/addresses ', 'Validatable\ValidatableController@addresses');
                Route::post('{common_validatable}/addresses ', 'Validatable\ValidatableController@saveAddresses');

                Route::get('/{common_validatable}/{subObjects}', 'Validatable\ValidatableController@relatedObjects');
                Route::get('/{common_validatable}', 'Validatable\ValidatableController@show');

                Route::post('/', 'Validatable\ValidatableController@store');
                Route::patch('/{common_validatable}', 'Validatable\ValidatableController@update');
                Route::delete('/{common_validatable}', 'Validatable\ValidatableController@destroy');
            }
        );

        Route::prefix('phone-numbers')->group(
            function () {
                Route::get('/', 'PhoneNumbers\PhoneNumbersController@index');

                Route::get('{common_phone_numbers}/tags ', 'PhoneNumbers\PhoneNumbersController@tags');
                Route::post('{common_phone_numbers}/tags ', 'PhoneNumbers\PhoneNumbersController@saveTags');
                Route::get('{common_phone_numbers}/addresses ', 'PhoneNumbers\PhoneNumbersController@addresses');
                Route::post('{common_phone_numbers}/addresses ', 'PhoneNumbers\PhoneNumbersController@saveAddresses');

                Route::get('/{common_phone_numbers}/{subObjects}', 'PhoneNumbers\PhoneNumbersController@relatedObjects');
                Route::get('/{common_phone_numbers}', 'PhoneNumbers\PhoneNumbersController@show');

                Route::post('/', 'PhoneNumbers\PhoneNumbersController@store');
                Route::patch('/{common_phone_numbers}', 'PhoneNumbers\PhoneNumbersController@update');
                Route::delete('/{common_phone_numbers}', 'PhoneNumbers\PhoneNumbersController@destroy');
            }
        );

        Route::prefix('votes')->group(
            function () {
                Route::get('/', 'Votes\VotesController@index');

                Route::get('{common_votes}/tags ', 'Votes\VotesController@tags');
                Route::post('{common_votes}/tags ', 'Votes\VotesController@saveTags');
                Route::get('{common_votes}/addresses ', 'Votes\VotesController@addresses');
                Route::post('{common_votes}/addresses ', 'Votes\VotesController@saveAddresses');

                Route::get('/{common_votes}/{subObjects}', 'Votes\VotesController@relatedObjects');
                Route::get('/{common_votes}', 'Votes\VotesController@show');

                Route::post('/', 'Votes\VotesController@store');
                Route::patch('/{common_votes}', 'Votes\VotesController@update');
                Route::delete('/{common_votes}', 'Votes\VotesController@destroy');
            }
        );

        Route::prefix('countries')->group(
            function () {
                Route::get('/', 'Countries\CountriesController@index');

                Route::get('{common_countries}/tags ', 'Countries\CountriesController@tags');
                Route::post('{common_countries}/tags ', 'Countries\CountriesController@saveTags');
                Route::get('{common_countries}/addresses ', 'Countries\CountriesController@addresses');
                Route::post('{common_countries}/addresses ', 'Countries\CountriesController@saveAddresses');

                Route::get('/{common_countries}/{subObjects}', 'Countries\CountriesController@relatedObjects');
                Route::get('/{common_countries}', 'Countries\CountriesController@show');

                Route::post('/', 'Countries\CountriesController@store');
                Route::patch('/{common_countries}', 'Countries\CountriesController@update');
                Route::delete('/{common_countries}', 'Countries\CountriesController@destroy');
            }
        );

        Route::prefix('cities')->group(
            function () {
                Route::get('/', 'Cities\CitiesController@index');

                Route::get('{common_cities}/tags ', 'Cities\CitiesController@tags');
                Route::post('{common_cities}/tags ', 'Cities\CitiesController@saveTags');
                Route::get('{common_cities}/addresses ', 'Cities\CitiesController@addresses');
                Route::post('{common_cities}/addresses ', 'Cities\CitiesController@saveAddresses');

                Route::get('/{common_cities}/{subObjects}', 'Cities\CitiesController@relatedObjects');
                Route::get('/{common_cities}', 'Cities\CitiesController@show');

                Route::post('/', 'Cities\CitiesController@store');
                Route::patch('/{common_cities}', 'Cities\CitiesController@update');
                Route::delete('/{common_cities}', 'Cities\CitiesController@destroy');
            }
        );

        Route::prefix('addresses')->group(
            function () {
                Route::get('/', 'Addresses\AddressesController@index');

                Route::get('{common_addresses}/tags ', 'Addresses\AddressesController@tags');
                Route::post('{common_addresses}/tags ', 'Addresses\AddressesController@saveTags');
                Route::get('{common_addresses}/addresses ', 'Addresses\AddressesController@addresses');
                Route::post('{common_addresses}/addresses ', 'Addresses\AddressesController@saveAddresses');

                Route::get('/{common_addresses}/{subObjects}', 'Addresses\AddressesController@relatedObjects');
                Route::get('/{common_addresses}', 'Addresses\AddressesController@show');

                Route::post('/', 'Addresses\AddressesController@store');
                Route::patch('/{common_addresses}', 'Addresses\AddressesController@update');
                Route::delete('/{common_addresses}', 'Addresses\AddressesController@destroy');
            }
        );

        Route::prefix('currencies')->group(
            function () {
                Route::get('/', 'Currencies\CurrenciesController@index');

                Route::get('{common_currencies}/tags ', 'Currencies\CurrenciesController@tags');
                Route::post('{common_currencies}/tags ', 'Currencies\CurrenciesController@saveTags');
                Route::get('{common_currencies}/addresses ', 'Currencies\CurrenciesController@addresses');
                Route::post('{common_currencies}/addresses ', 'Currencies\CurrenciesController@saveAddresses');

                Route::get('/{common_currencies}/{subObjects}', 'Currencies\CurrenciesController@relatedObjects');
                Route::get('/{common_currencies}', 'Currencies\CurrenciesController@show');

                Route::post('/', 'Currencies\CurrenciesController@store');
                Route::patch('/{common_currencies}', 'Currencies\CurrenciesController@update');
                Route::delete('/{common_currencies}', 'Currencies\CurrenciesController@destroy');
            }
        );

        Route::prefix('domains')->group(
            function () {
                Route::get('/', 'Domains\DomainsController@index');

                Route::get('{common_domains}/tags ', 'Domains\DomainsController@tags');
                Route::post('{common_domains}/tags ', 'Domains\DomainsController@saveTags');
                Route::get('{common_domains}/addresses ', 'Domains\DomainsController@addresses');
                Route::post('{common_domains}/addresses ', 'Domains\DomainsController@saveAddresses');

                Route::get('/{common_domains}/{subObjects}', 'Domains\DomainsController@relatedObjects');
                Route::get('/{common_domains}', 'Domains\DomainsController@show');

                Route::post('/', 'Domains\DomainsController@store');
                Route::patch('/{common_domains}', 'Domains\DomainsController@update');
                Route::delete('/{common_domains}', 'Domains\DomainsController@destroy');
            }
        );

        Route::prefix('comments')->group(
            function () {
                Route::get('/', 'Comments\CommentsController@index');

                Route::get('{common_comments}/tags ', 'Comments\CommentsController@tags');
                Route::post('{common_comments}/tags ', 'Comments\CommentsController@saveTags');
                Route::get('{common_comments}/addresses ', 'Comments\CommentsController@addresses');
                Route::post('{common_comments}/addresses ', 'Comments\CommentsController@saveAddresses');

                Route::get('/{common_comments}/{subObjects}', 'Comments\CommentsController@relatedObjects');
                Route::get('/{common_comments}', 'Comments\CommentsController@show');

                Route::post('/', 'Comments\CommentsController@store');
                Route::patch('/{common_comments}', 'Comments\CommentsController@update');
                Route::delete('/{common_comments}', 'Comments\CommentsController@destroy');
            }
        );

        Route::prefix('actions')->group(
            function () {
                Route::get('/', 'Actions\ActionsController@index');

                Route::get('{common_actions}/tags ', 'Actions\ActionsController@tags');
                Route::post('{common_actions}/tags ', 'Actions\ActionsController@saveTags');
                Route::get('{common_actions}/addresses ', 'Actions\ActionsController@addresses');
                Route::post('{common_actions}/addresses ', 'Actions\ActionsController@saveAddresses');

                Route::get('/{common_actions}/{subObjects}', 'Actions\ActionsController@relatedObjects');
                Route::get('/{common_actions}', 'Actions\ActionsController@show');

                Route::post('/', 'Actions\ActionsController@store');
                Route::patch('/{common_actions}', 'Actions\ActionsController@update');
                Route::delete('/{common_actions}', 'Actions\ActionsController@destroy');
            }
        );

        Route::prefix('categories')->group(
            function () {
                Route::get('/', 'Categories\CategoriesController@index');

                Route::get('{common_categories}/tags ', 'Categories\CategoriesController@tags');
                Route::post('{common_categories}/tags ', 'Categories\CategoriesController@saveTags');
                Route::get('{common_categories}/addresses ', 'Categories\CategoriesController@addresses');
                Route::post('{common_categories}/addresses ', 'Categories\CategoriesController@saveAddresses');

                Route::get('/{common_categories}/{subObjects}', 'Categories\CategoriesController@relatedObjects');
                Route::get('/{common_categories}', 'Categories\CategoriesController@show');

                Route::post('/', 'Categories\CategoriesController@store');
                Route::patch('/{common_categories}', 'Categories\CategoriesController@update');
                Route::delete('/{common_categories}', 'Categories\CategoriesController@destroy');
            }
        );

        Route::prefix('disposable-emails')->group(
            function () {
                Route::get('/', 'DisposableEmails\DisposableEmailsController@index');

                Route::get('{common_disposable_emails}/tags ', 'DisposableEmails\DisposableEmailsController@tags');
                Route::post('{common_disposable_emails}/tags ', 'DisposableEmails\DisposableEmailsController@saveTags');
                Route::get('{common_disposable_emails}/addresses ', 'DisposableEmails\DisposableEmailsController@addresses');
                Route::post('{common_disposable_emails}/addresses ', 'DisposableEmails\DisposableEmailsController@saveAddresses');

                Route::get('/{common_disposable_emails}/{subObjects}', 'DisposableEmails\DisposableEmailsController@relatedObjects');
                Route::get('/{common_disposable_emails}', 'DisposableEmails\DisposableEmailsController@show');

                Route::post('/', 'DisposableEmails\DisposableEmailsController@store');
                Route::patch('/{common_disposable_emails}', 'DisposableEmails\DisposableEmailsController@update');
                Route::delete('/{common_disposable_emails}', 'DisposableEmails\DisposableEmailsController@destroy');
            }
        );

        Route::prefix('action-logs')->group(
            function () {
                Route::get('/', 'ActionLogs\ActionLogsController@index');

                Route::get('{common_action_logs}/tags ', 'ActionLogs\ActionLogsController@tags');
                Route::post('{common_action_logs}/tags ', 'ActionLogs\ActionLogsController@saveTags');
                Route::get('{common_action_logs}/addresses ', 'ActionLogs\ActionLogsController@addresses');
                Route::post('{common_action_logs}/addresses ', 'ActionLogs\ActionLogsController@saveAddresses');

                Route::get('/{common_action_logs}/{subObjects}', 'ActionLogs\ActionLogsController@relatedObjects');
                Route::get('/{common_action_logs}', 'ActionLogs\ActionLogsController@show');

                Route::post('/', 'ActionLogs\ActionLogsController@store');
                Route::patch('/{common_action_logs}', 'ActionLogs\ActionLogsController@update');
                Route::delete('/{common_action_logs}', 'ActionLogs\ActionLogsController@destroy');
            }
        );

        Route::prefix('country-states')->group(
            function () {
                Route::get('/', 'CountryStates\CountryStatesController@index');

                Route::get('{common_country_states}/tags ', 'CountryStates\CountryStatesController@tags');
                Route::post('{common_country_states}/tags ', 'CountryStates\CountryStatesController@saveTags');
                Route::get('{common_country_states}/addresses ', 'CountryStates\CountryStatesController@addresses');
                Route::post('{common_country_states}/addresses ', 'CountryStates\CountryStatesController@saveAddresses');

                Route::get('/{common_country_states}/{subObjects}', 'CountryStates\CountryStatesController@relatedObjects');
                Route::get('/{common_country_states}', 'CountryStates\CountryStatesController@show');

                Route::post('/', 'CountryStates\CountryStatesController@store');
                Route::patch('/{common_country_states}', 'CountryStates\CountryStatesController@update');
                Route::delete('/{common_country_states}', 'CountryStates\CountryStatesController@destroy');
            }
        );

        Route::prefix('exchange-rates')->group(
            function () {
                Route::get('/', 'ExchangeRates\ExchangeRatesController@index');

                Route::get('{common_exchange_rates}/tags ', 'ExchangeRates\ExchangeRatesController@tags');
                Route::post('{common_exchange_rates}/tags ', 'ExchangeRates\ExchangeRatesController@saveTags');
                Route::get('{common_exchange_rates}/addresses ', 'ExchangeRates\ExchangeRatesController@addresses');
                Route::post('{common_exchange_rates}/addresses ', 'ExchangeRates\ExchangeRatesController@saveAddresses');

                Route::get('/{common_exchange_rates}/{subObjects}', 'ExchangeRates\ExchangeRatesController@relatedObjects');
                Route::get('/{common_exchange_rates}', 'ExchangeRates\ExchangeRatesController@show');

                Route::post('/', 'ExchangeRates\ExchangeRatesController@store');
                Route::patch('/{common_exchange_rates}', 'ExchangeRates\ExchangeRatesController@update');
                Route::delete('/{common_exchange_rates}', 'ExchangeRates\ExchangeRatesController@destroy');
            }
        );

        Route::prefix('languages')->group(
            function () {
                Route::get('/', 'Languages\LanguagesController@index');

                Route::get('{common_languages}/tags ', 'Languages\LanguagesController@tags');
                Route::post('{common_languages}/tags ', 'Languages\LanguagesController@saveTags');
                Route::get('{common_languages}/addresses ', 'Languages\LanguagesController@addresses');
                Route::post('{common_languages}/addresses ', 'Languages\LanguagesController@saveAddresses');

                Route::get('/{common_languages}/{subObjects}', 'Languages\LanguagesController@relatedObjects');
                Route::get('/{common_languages}', 'Languages\LanguagesController@show');

                Route::post('/', 'Languages\LanguagesController@store');
                Route::patch('/{common_languages}', 'Languages\LanguagesController@update');
                Route::delete('/{common_languages}', 'Languages\LanguagesController@destroy');
            }
        );

        Route::prefix('media')->group(
            function () {
                Route::get('/', 'Media\MediaController@index');

                Route::get('{common_media}/tags ', 'Media\MediaController@tags');
                Route::post('{common_media}/tags ', 'Media\MediaController@saveTags');
                Route::get('{common_media}/addresses ', 'Media\MediaController@addresses');
                Route::post('{common_media}/addresses ', 'Media\MediaController@saveAddresses');

                Route::get('/{common_media}/{subObjects}', 'Media\MediaController@relatedObjects');
                Route::get('/{common_media}', 'Media\MediaController@show');

                Route::post('/', 'Media\MediaController@store');
                Route::patch('/{common_media}', 'Media\MediaController@update');
                Route::delete('/{common_media}', 'Media\MediaController@destroy');
            }
        );

        Route::prefix('meta')->group(
            function () {
                Route::get('/', 'Meta\MetaController@index');

                Route::get('{common_meta}/tags ', 'Meta\MetaController@tags');
                Route::post('{common_meta}/tags ', 'Meta\MetaController@saveTags');
                Route::get('{common_meta}/addresses ', 'Meta\MetaController@addresses');
                Route::post('{common_meta}/addresses ', 'Meta\MetaController@saveAddresses');

                Route::get('/{common_meta}/{subObjects}', 'Meta\MetaController@relatedObjects');
                Route::get('/{common_meta}', 'Meta\MetaController@show');

                Route::post('/', 'Meta\MetaController@store');
                Route::patch('/{common_meta}', 'Meta\MetaController@update');
                Route::delete('/{common_meta}', 'Meta\MetaController@destroy');
            }
        );

        Route::prefix('registries')->group(
            function () {
                Route::get('/', 'Registries\RegistriesController@index');

                Route::get('{common_registries}/tags ', 'Registries\RegistriesController@tags');
                Route::post('{common_registries}/tags ', 'Registries\RegistriesController@saveTags');
                Route::get('{common_registries}/addresses ', 'Registries\RegistriesController@addresses');
                Route::post('{common_registries}/addresses ', 'Registries\RegistriesController@saveAddresses');

                Route::get('/{common_registries}/{subObjects}', 'Registries\RegistriesController@relatedObjects');
                Route::get('/{common_registries}', 'Registries\RegistriesController@show');

                Route::post('/', 'Registries\RegistriesController@store');
                Route::patch('/{common_registries}', 'Registries\RegistriesController@update');
                Route::delete('/{common_registries}', 'Registries\RegistriesController@destroy');
            }
        );

        Route::prefix('social-media')->group(
            function () {
                Route::get('/', 'SocialMedia\SocialMediaController@index');

                Route::get('{common_social_media}/tags ', 'SocialMedia\SocialMediaController@tags');
                Route::post('{common_social_media}/tags ', 'SocialMedia\SocialMediaController@saveTags');
                Route::get('{common_social_media}/addresses ', 'SocialMedia\SocialMediaController@addresses');
                Route::post('{common_social_media}/addresses ', 'SocialMedia\SocialMediaController@saveAddresses');

                Route::get('/{common_social_media}/{subObjects}', 'SocialMedia\SocialMediaController@relatedObjects');
                Route::get('/{common_social_media}', 'SocialMedia\SocialMediaController@show');

                Route::post('/', 'SocialMedia\SocialMediaController@store');
                Route::patch('/{common_social_media}', 'SocialMedia\SocialMediaController@update');
                Route::delete('/{common_social_media}', 'SocialMedia\SocialMediaController@destroy');
            }
        );

        Route::prefix('states')->group(
            function () {
                Route::get('/', 'States\StatesController@index');

                Route::get('{common_states}/tags ', 'States\StatesController@tags');
                Route::post('{common_states}/tags ', 'States\StatesController@saveTags');
                Route::get('{common_states}/addresses ', 'States\StatesController@addresses');
                Route::post('{common_states}/addresses ', 'States\StatesController@saveAddresses');

                Route::get('/{common_states}/{subObjects}', 'States\StatesController@relatedObjects');
                Route::get('/{common_states}', 'States\StatesController@show');

                Route::post('/', 'States\StatesController@store');
                Route::patch('/{common_states}', 'States\StatesController@update');
                Route::delete('/{common_states}', 'States\StatesController@destroy');
            }
        );

        Route::prefix('tags')->group(
            function () {
                Route::get('/', 'Tags\TagsController@index');

                Route::get('{common_tags}/tags ', 'Tags\TagsController@tags');
                Route::post('{common_tags}/tags ', 'Tags\TagsController@saveTags');
                Route::get('{common_tags}/addresses ', 'Tags\TagsController@addresses');
                Route::post('{common_tags}/addresses ', 'Tags\TagsController@saveAddresses');

                Route::get('/{common_tags}/{subObjects}', 'Tags\TagsController@relatedObjects');
                Route::get('/{common_tags}', 'Tags\TagsController@show');

                Route::post('/', 'Tags\TagsController@store');
                Route::patch('/{common_tags}', 'Tags\TagsController@update');
                Route::delete('/{common_tags}', 'Tags\TagsController@destroy');
            }
        );

        Route::prefix('validatable')->group(
            function () {
                Route::get('/', 'Validatable\ValidatableController@index');

                Route::get('{common_validatable}/tags ', 'Validatable\ValidatableController@tags');
                Route::post('{common_validatable}/tags ', 'Validatable\ValidatableController@saveTags');
                Route::get('{common_validatable}/addresses ', 'Validatable\ValidatableController@addresses');
                Route::post('{common_validatable}/addresses ', 'Validatable\ValidatableController@saveAddresses');

                Route::get('/{common_validatable}/{subObjects}', 'Validatable\ValidatableController@relatedObjects');
                Route::get('/{common_validatable}', 'Validatable\ValidatableController@show');

                Route::post('/', 'Validatable\ValidatableController@store');
                Route::patch('/{common_validatable}', 'Validatable\ValidatableController@update');
                Route::delete('/{common_validatable}', 'Validatable\ValidatableController@destroy');
            }
        );

        Route::prefix('phone-numbers')->group(
            function () {
                Route::get('/', 'PhoneNumbers\PhoneNumbersController@index');

                Route::get('{common_phone_numbers}/tags ', 'PhoneNumbers\PhoneNumbersController@tags');
                Route::post('{common_phone_numbers}/tags ', 'PhoneNumbers\PhoneNumbersController@saveTags');
                Route::get('{common_phone_numbers}/addresses ', 'PhoneNumbers\PhoneNumbersController@addresses');
                Route::post('{common_phone_numbers}/addresses ', 'PhoneNumbers\PhoneNumbersController@saveAddresses');

                Route::get('/{common_phone_numbers}/{subObjects}', 'PhoneNumbers\PhoneNumbersController@relatedObjects');
                Route::get('/{common_phone_numbers}', 'PhoneNumbers\PhoneNumbersController@show');

                Route::post('/', 'PhoneNumbers\PhoneNumbersController@store');
                Route::patch('/{common_phone_numbers}', 'PhoneNumbers\PhoneNumbersController@update');
                Route::delete('/{common_phone_numbers}', 'PhoneNumbers\PhoneNumbersController@destroy');
            }
        );

        Route::prefix('votes')->group(
            function () {
                Route::get('/', 'Votes\VotesController@index');

                Route::get('{common_votes}/tags ', 'Votes\VotesController@tags');
                Route::post('{common_votes}/tags ', 'Votes\VotesController@saveTags');
                Route::get('{common_votes}/addresses ', 'Votes\VotesController@addresses');
                Route::post('{common_votes}/addresses ', 'Votes\VotesController@saveAddresses');

                Route::get('/{common_votes}/{subObjects}', 'Votes\VotesController@relatedObjects');
                Route::get('/{common_votes}', 'Votes\VotesController@show');

                Route::post('/', 'Votes\VotesController@store');
                Route::patch('/{common_votes}', 'Votes\VotesController@update');
                Route::delete('/{common_votes}', 'Votes\VotesController@destroy');
            }
        );

        Route::prefix('countries')->group(
            function () {
                Route::get('/', 'Countries\CountriesController@index');

                Route::get('{common_countries}/tags ', 'Countries\CountriesController@tags');
                Route::post('{common_countries}/tags ', 'Countries\CountriesController@saveTags');
                Route::get('{common_countries}/addresses ', 'Countries\CountriesController@addresses');
                Route::post('{common_countries}/addresses ', 'Countries\CountriesController@saveAddresses');

                Route::get('/{common_countries}/{subObjects}', 'Countries\CountriesController@relatedObjects');
                Route::get('/{common_countries}', 'Countries\CountriesController@show');

                Route::post('/', 'Countries\CountriesController@store');
                Route::patch('/{common_countries}', 'Countries\CountriesController@update');
                Route::delete('/{common_countries}', 'Countries\CountriesController@destroy');
            }
        );

        Route::prefix('cities')->group(
            function () {
                Route::get('/', 'Cities\CitiesController@index');

                Route::get('{common_cities}/tags ', 'Cities\CitiesController@tags');
                Route::post('{common_cities}/tags ', 'Cities\CitiesController@saveTags');
                Route::get('{common_cities}/addresses ', 'Cities\CitiesController@addresses');
                Route::post('{common_cities}/addresses ', 'Cities\CitiesController@saveAddresses');

                Route::get('/{common_cities}/{subObjects}', 'Cities\CitiesController@relatedObjects');
                Route::get('/{common_cities}', 'Cities\CitiesController@show');

                Route::post('/', 'Cities\CitiesController@store');
                Route::patch('/{common_cities}', 'Cities\CitiesController@update');
                Route::delete('/{common_cities}', 'Cities\CitiesController@destroy');
            }
        );

        Route::prefix('addresses')->group(
            function () {
                Route::get('/', 'Addresses\AddressesController@index');

                Route::get('{common_addresses}/tags ', 'Addresses\AddressesController@tags');
                Route::post('{common_addresses}/tags ', 'Addresses\AddressesController@saveTags');
                Route::get('{common_addresses}/addresses ', 'Addresses\AddressesController@addresses');
                Route::post('{common_addresses}/addresses ', 'Addresses\AddressesController@saveAddresses');

                Route::get('/{common_addresses}/{subObjects}', 'Addresses\AddressesController@relatedObjects');
                Route::get('/{common_addresses}', 'Addresses\AddressesController@show');

                Route::post('/', 'Addresses\AddressesController@store');
                Route::patch('/{common_addresses}', 'Addresses\AddressesController@update');
                Route::delete('/{common_addresses}', 'Addresses\AddressesController@destroy');
            }
        );

        Route::prefix('currencies')->group(
            function () {
                Route::get('/', 'Currencies\CurrenciesController@index');

                Route::get('{common_currencies}/tags ', 'Currencies\CurrenciesController@tags');
                Route::post('{common_currencies}/tags ', 'Currencies\CurrenciesController@saveTags');
                Route::get('{common_currencies}/addresses ', 'Currencies\CurrenciesController@addresses');
                Route::post('{common_currencies}/addresses ', 'Currencies\CurrenciesController@saveAddresses');

                Route::get('/{common_currencies}/{subObjects}', 'Currencies\CurrenciesController@relatedObjects');
                Route::get('/{common_currencies}', 'Currencies\CurrenciesController@show');

                Route::post('/', 'Currencies\CurrenciesController@store');
                Route::patch('/{common_currencies}', 'Currencies\CurrenciesController@update');
                Route::delete('/{common_currencies}', 'Currencies\CurrenciesController@destroy');
            }
        );

        Route::prefix('domains')->group(
            function () {
                Route::get('/', 'Domains\DomainsController@index');

                Route::get('{common_domains}/tags ', 'Domains\DomainsController@tags');
                Route::post('{common_domains}/tags ', 'Domains\DomainsController@saveTags');
                Route::get('{common_domains}/addresses ', 'Domains\DomainsController@addresses');
                Route::post('{common_domains}/addresses ', 'Domains\DomainsController@saveAddresses');

                Route::get('/{common_domains}/{subObjects}', 'Domains\DomainsController@relatedObjects');
                Route::get('/{common_domains}', 'Domains\DomainsController@show');

                Route::post('/', 'Domains\DomainsController@store');
                Route::patch('/{common_domains}', 'Domains\DomainsController@update');
                Route::delete('/{common_domains}', 'Domains\DomainsController@destroy');
            }
        );

        Route::prefix('comments')->group(
            function () {
                Route::get('/', 'Comments\CommentsController@index');

                Route::get('{common_comments}/tags ', 'Comments\CommentsController@tags');
                Route::post('{common_comments}/tags ', 'Comments\CommentsController@saveTags');
                Route::get('{common_comments}/addresses ', 'Comments\CommentsController@addresses');
                Route::post('{common_comments}/addresses ', 'Comments\CommentsController@saveAddresses');

                Route::get('/{common_comments}/{subObjects}', 'Comments\CommentsController@relatedObjects');
                Route::get('/{common_comments}', 'Comments\CommentsController@show');

                Route::post('/', 'Comments\CommentsController@store');
                Route::patch('/{common_comments}', 'Comments\CommentsController@update');
                Route::delete('/{common_comments}', 'Comments\CommentsController@destroy');
            }
        );

        Route::prefix('actions')->group(
            function () {
                Route::get('/', 'Actions\ActionsController@index');

                Route::get('{common_actions}/tags ', 'Actions\ActionsController@tags');
                Route::post('{common_actions}/tags ', 'Actions\ActionsController@saveTags');
                Route::get('{common_actions}/addresses ', 'Actions\ActionsController@addresses');
                Route::post('{common_actions}/addresses ', 'Actions\ActionsController@saveAddresses');

                Route::get('/{common_actions}/{subObjects}', 'Actions\ActionsController@relatedObjects');
                Route::get('/{common_actions}', 'Actions\ActionsController@show');

                Route::post('/', 'Actions\ActionsController@store');
                Route::patch('/{common_actions}', 'Actions\ActionsController@update');
                Route::delete('/{common_actions}', 'Actions\ActionsController@destroy');
            }
        );

        Route::prefix('categories')->group(
            function () {
                Route::get('/', 'Categories\CategoriesController@index');

                Route::get('{common_categories}/tags ', 'Categories\CategoriesController@tags');
                Route::post('{common_categories}/tags ', 'Categories\CategoriesController@saveTags');
                Route::get('{common_categories}/addresses ', 'Categories\CategoriesController@addresses');
                Route::post('{common_categories}/addresses ', 'Categories\CategoriesController@saveAddresses');

                Route::get('/{common_categories}/{subObjects}', 'Categories\CategoriesController@relatedObjects');
                Route::get('/{common_categories}', 'Categories\CategoriesController@show');

                Route::post('/', 'Categories\CategoriesController@store');
                Route::patch('/{common_categories}', 'Categories\CategoriesController@update');
                Route::delete('/{common_categories}', 'Categories\CategoriesController@destroy');
            }
        );

        Route::prefix('disposable-emails')->group(
            function () {
                Route::get('/', 'DisposableEmails\DisposableEmailsController@index');

                Route::get('{common_disposable_emails}/tags ', 'DisposableEmails\DisposableEmailsController@tags');
                Route::post('{common_disposable_emails}/tags ', 'DisposableEmails\DisposableEmailsController@saveTags');
                Route::get('{common_disposable_emails}/addresses ', 'DisposableEmails\DisposableEmailsController@addresses');
                Route::post('{common_disposable_emails}/addresses ', 'DisposableEmails\DisposableEmailsController@saveAddresses');

                Route::get('/{common_disposable_emails}/{subObjects}', 'DisposableEmails\DisposableEmailsController@relatedObjects');
                Route::get('/{common_disposable_emails}', 'DisposableEmails\DisposableEmailsController@show');

                Route::post('/', 'DisposableEmails\DisposableEmailsController@store');
                Route::patch('/{common_disposable_emails}', 'DisposableEmails\DisposableEmailsController@update');
                Route::delete('/{common_disposable_emails}', 'DisposableEmails\DisposableEmailsController@destroy');
            }
        );

        Route::prefix('action-logs')->group(
            function () {
                Route::get('/', 'ActionLogs\ActionLogsController@index');

                Route::get('{common_action_logs}/tags ', 'ActionLogs\ActionLogsController@tags');
                Route::post('{common_action_logs}/tags ', 'ActionLogs\ActionLogsController@saveTags');
                Route::get('{common_action_logs}/addresses ', 'ActionLogs\ActionLogsController@addresses');
                Route::post('{common_action_logs}/addresses ', 'ActionLogs\ActionLogsController@saveAddresses');

                Route::get('/{common_action_logs}/{subObjects}', 'ActionLogs\ActionLogsController@relatedObjects');
                Route::get('/{common_action_logs}', 'ActionLogs\ActionLogsController@show');

                Route::post('/', 'ActionLogs\ActionLogsController@store');
                Route::patch('/{common_action_logs}', 'ActionLogs\ActionLogsController@update');
                Route::delete('/{common_action_logs}', 'ActionLogs\ActionLogsController@destroy');
            }
        );

        // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE













































































































































        Route::get('/tags/object', 'Taggables\ObjectTagsController@index');
        Route::post('/tags/object', 'Taggables\ObjectTagsController@store');
    }
);


































































