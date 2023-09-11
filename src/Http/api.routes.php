<?php

Route::prefix('commons')->group(
    function () {
        Route::prefix('addresses')->group(
            function () {
                Route::get('/', 'Addresses\AddressesController@index');
                Route::get('/{common_addresses}', 'Addresses\AddressesController@show');
                Route::post('/', 'Addresses\AddressesController@store');
                Route::patch('/{common_addresses}', 'Addresses\AddressesController@update');
                Route::delete('/{common_addresses}', 'Addresses\AddressesController@destroy');
            }
        );

        Route::prefix('categories')->group(
            function () {
                Route::get('/', 'Categories\CategoriesController@index');
                Route::get('/{common_categories}', 'Categories\CategoriesController@show');
                Route::post('/', 'Categories\CategoriesController@store');
                Route::patch('/{common_categories}', 'Categories\CategoriesController@update');
                Route::delete('/{common_categories}', 'Categories\CategoriesController@destroy');
            }
        );

        Route::prefix('comments')->group(
            function () {
                Route::get('/', 'Comments\CommentsController@index');
                Route::get('/{common_comments}', 'Comments\CommentsController@show');
                Route::post('/', 'Comments\CommentsController@store');
                Route::patch('/{common_comments}', 'Comments\CommentsController@update');
                Route::delete('/{common_comments}', 'Comments\CommentsController@destroy');
            }
        );

        Route::prefix('countries')->group(
            function () {
                Route::get('/', 'Countries\CountriesController@index');
                Route::get('/{common_countries}', 'Countries\CountriesController@show');
                Route::post('/', 'Countries\CountriesController@store');
                Route::patch('/{common_countries}', 'Countries\CountriesController@update');
                Route::delete('/{common_countries}', 'Countries\CountriesController@destroy');
            }
        );

        Route::prefix('disposable-emails')->group(
            function () {
                Route::get('/', 'DisposableEmails\DisposableEmailsController@index');
                Route::get('/{common_disposable_emails}', 'DisposableEmails\DisposableEmailsController@show');
                Route::post('/', 'DisposableEmails\DisposableEmailsController@store');
                Route::patch('/{common_disposable_emails}', 'DisposableEmails\DisposableEmailsController@update');
                Route::delete('/{common_disposable_emails}', 'DisposableEmails\DisposableEmailsController@destroy');
            }
        );

        Route::prefix('domainables')->group(
            function () {
                Route::get('/', 'Domainables\DomainablesController@index');
                Route::get('/{common_domainables}', 'Domainables\DomainablesController@show');
                Route::post('/', 'Domainables\DomainablesController@store');
                Route::patch('/{common_domainables}', 'Domainables\DomainablesController@update');
                Route::delete('/{common_domainables}', 'Domainables\DomainablesController@destroy');
            }
        );

        Route::prefix('domains')->group(
            function () {
                Route::get('/', 'Domains\DomainsController@index');
                Route::get('/{common_domains}', 'Domains\DomainsController@show');
                Route::post('/', 'Domains\DomainsController@store');
                Route::patch('/{common_domains}', 'Domains\DomainsController@update');
                Route::delete('/{common_domains}', 'Domains\DomainsController@destroy');
            }
        );

        Route::prefix('exchange-rates')->group(
            function () {
                Route::get('/', 'ExchangeRates\ExchangeRatesController@index');
                Route::get('/{common_exchange_rates}', 'ExchangeRates\ExchangeRatesController@show');
                Route::post('/', 'ExchangeRates\ExchangeRatesController@store');
                Route::patch('/{common_exchange_rates}', 'ExchangeRates\ExchangeRatesController@update');
                Route::delete('/{common_exchange_rates}', 'ExchangeRates\ExchangeRatesController@destroy');
            }
        );

        Route::prefix('languages')->group(
            function () {
                Route::get('/', 'Languages\LanguagesController@index');
                Route::get('/{common_languages}', 'Languages\LanguagesController@show');
                Route::post('/', 'Languages\LanguagesController@store');
                Route::patch('/{common_languages}', 'Languages\LanguagesController@update');
                Route::delete('/{common_languages}', 'Languages\LanguagesController@destroy');
            }
        );

        Route::prefix('media')->group(
            function () {
                Route::get('/', 'Media\MediaController@index');
                Route::get('/{common_media}', 'Media\MediaController@show');
                Route::post('/', 'Media\MediaController@store');
                Route::patch('/{common_media}', 'Media\MediaController@update');
                Route::delete('/{common_media}', 'Media\MediaController@destroy');
            }
        );

        Route::prefix('meta')->group(
            function () {
                Route::get('/', 'Meta\MetaController@index');
                Route::get('/{common_meta}', 'Meta\MetaController@show');
                Route::post('/', 'Meta\MetaController@store');
                Route::patch('/{common_meta}', 'Meta\MetaController@update');
                Route::delete('/{common_meta}', 'Meta\MetaController@destroy');
            }
        );

        Route::prefix('registries')->group(
            function () {
                Route::get('/', 'Registries\RegistriesController@index');
                Route::get('/{common_registries}', 'Registries\RegistriesController@show');
                Route::post('/', 'Registries\RegistriesController@store');
                Route::patch('/{common_registries}', 'Registries\RegistriesController@update');
                Route::delete('/{common_registries}', 'Registries\RegistriesController@destroy');
            }
        );

        Route::prefix('social-media')->group(
            function () {
                Route::get('/', 'SocialMedia\SocialMediaController@index');
                Route::get('/{common_social_media}', 'SocialMedia\SocialMediaController@show');
                Route::post('/', 'SocialMedia\SocialMediaController@store');
                Route::patch('/{common_social_media}', 'SocialMedia\SocialMediaController@update');
                Route::delete('/{common_social_media}', 'SocialMedia\SocialMediaController@destroy');
            }
        );

        Route::prefix('states')->group(
            function () {
                Route::get('/', 'States\StatesController@index');
                Route::get('/{common_states}', 'States\StatesController@show');
                Route::post('/', 'States\StatesController@store');
                Route::patch('/{common_states}', 'States\StatesController@update');
                Route::delete('/{common_states}', 'States\StatesController@destroy');
            }
        );

        Route::prefix('taggables')->group(
            function () {
                Route::get('/', 'Taggables\TaggablesController@index');
                Route::get('/{common_taggables}', 'Taggables\TaggablesController@show');
                Route::post('/', 'Taggables\TaggablesController@store');
                Route::patch('/{common_taggables}', 'Taggables\TaggablesController@update');
                Route::delete('/{common_taggables}', 'Taggables\TaggablesController@destroy');
            }
        );

        Route::prefix('tags')->group(
            function () {
                Route::get('/', 'Tags\TagsController@index');
                Route::get('/{common_tags}', 'Tags\TagsController@show');
                Route::post('/', 'Tags\TagsController@store');
                Route::patch('/{common_tags}', 'Tags\TagsController@update');
                Route::delete('/{common_tags}', 'Tags\TagsController@destroy');
            }
        );

        Route::prefix('validatable')->group(
            function () {
                Route::get('/', 'Validatable\ValidatableController@index');
                Route::get('/{common_validatable}', 'Validatable\ValidatableController@show');
                Route::post('/', 'Validatable\ValidatableController@store');
                Route::patch('/{common_validatable}', 'Validatable\ValidatableController@update');
                Route::delete('/{common_validatable}', 'Validatable\ValidatableController@destroy');
            }
        );

        Route::prefix('votes')->group(
            function () {
                Route::get('/', 'Votes\VotesController@index');
                Route::get('/{common_votes}', 'Votes\VotesController@show');
                Route::post('/', 'Votes\VotesController@store');
                Route::patch('/{common_votes}', 'Votes\VotesController@update');
                Route::delete('/{common_votes}', 'Votes\VotesController@destroy');
            }
        );

        // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
    }
);
});