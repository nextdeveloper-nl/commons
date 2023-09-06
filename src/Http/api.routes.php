<?php

Route::prefix('commons')->group(function() {
Route::prefix('addresses')->group(function () {
        Route::get('/', 'CommonAddress\CommonAddressController@index');
        Route::get('/{common_addresses}', 'CommonAddress\CommonAddressController@show');
        Route::post('/', 'CommonAddress\CommonAddressController@store');
        Route::patch('/{common_addresses}', 'CommonAddress\CommonAddressController@update');
        Route::delete('/{common_addresses}', 'CommonAddress\CommonAddressController@destroy');
    });

Route::prefix('categories')->group(function () {
        Route::get('/', 'CommonCategory\CommonCategoryController@index');
        Route::get('/{common_categories}', 'CommonCategory\CommonCategoryController@show');
        Route::post('/', 'CommonCategory\CommonCategoryController@store');
        Route::patch('/{common_categories}', 'CommonCategory\CommonCategoryController@update');
        Route::delete('/{common_categories}', 'CommonCategory\CommonCategoryController@destroy');
    });

Route::prefix('comments')->group(function () {
        Route::get('/', 'CommonComment\CommonCommentController@index');
        Route::get('/{common_comments}', 'CommonComment\CommonCommentController@show');
        Route::post('/', 'CommonComment\CommonCommentController@store');
        Route::patch('/{common_comments}', 'CommonComment\CommonCommentController@update');
        Route::delete('/{common_comments}', 'CommonComment\CommonCommentController@destroy');
    });

Route::prefix('countries')->group(function () {
        Route::get('/', 'CommonCountry\CommonCountryController@index');
        Route::get('/{common_countries}', 'CommonCountry\CommonCountryController@show');
        Route::post('/', 'CommonCountry\CommonCountryController@store');
        Route::patch('/{common_countries}', 'CommonCountry\CommonCountryController@update');
        Route::delete('/{common_countries}', 'CommonCountry\CommonCountryController@destroy');
    });

Route::prefix('disposable-emails')->group(function () {
        Route::get('/', 'CommonDisposableEmail\CommonDisposableEmailController@index');
        Route::get('/{common_disposable_emails}', 'CommonDisposableEmail\CommonDisposableEmailController@show');
        Route::post('/', 'CommonDisposableEmail\CommonDisposableEmailController@store');
        Route::patch('/{common_disposable_emails}', 'CommonDisposableEmail\CommonDisposableEmailController@update');
        Route::delete('/{common_disposable_emails}', 'CommonDisposableEmail\CommonDisposableEmailController@destroy');
    });

Route::prefix('domainables')->group(function () {
        Route::get('/', 'CommonDomainable\CommonDomainableController@index');
        Route::get('/{common_domainables}', 'CommonDomainable\CommonDomainableController@show');
        Route::post('/', 'CommonDomainable\CommonDomainableController@store');
        Route::patch('/{common_domainables}', 'CommonDomainable\CommonDomainableController@update');
        Route::delete('/{common_domainables}', 'CommonDomainable\CommonDomainableController@destroy');
    });

Route::prefix('domains')->group(function () {
        Route::get('/', 'CommonDomain\CommonDomainController@index');
        Route::get('/{common_domains}', 'CommonDomain\CommonDomainController@show');
        Route::post('/', 'CommonDomain\CommonDomainController@store');
        Route::patch('/{common_domains}', 'CommonDomain\CommonDomainController@update');
        Route::delete('/{common_domains}', 'CommonDomain\CommonDomainController@destroy');
    });

Route::prefix('exchange-rates')->group(function () {
        Route::get('/', 'CommonExchangeRate\CommonExchangeRateController@index');
        Route::get('/{common_exchange_rates}', 'CommonExchangeRate\CommonExchangeRateController@show');
        Route::post('/', 'CommonExchangeRate\CommonExchangeRateController@store');
        Route::patch('/{common_exchange_rates}', 'CommonExchangeRate\CommonExchangeRateController@update');
        Route::delete('/{common_exchange_rates}', 'CommonExchangeRate\CommonExchangeRateController@destroy');
    });

Route::prefix('languages')->group(function () {
        Route::get('/', 'CommonLanguage\CommonLanguageController@index');
        Route::get('/{common_languages}', 'CommonLanguage\CommonLanguageController@show');
        Route::post('/', 'CommonLanguage\CommonLanguageController@store');
        Route::patch('/{common_languages}', 'CommonLanguage\CommonLanguageController@update');
        Route::delete('/{common_languages}', 'CommonLanguage\CommonLanguageController@destroy');
    });

Route::prefix('media')->group(function () {
        Route::get('/', 'CommonMedia\CommonMediaController@index');
        Route::get('/{common_media}', 'CommonMedia\CommonMediaController@show');
        Route::post('/', 'CommonMedia\CommonMediaController@store');
        Route::patch('/{common_media}', 'CommonMedia\CommonMediaController@update');
        Route::delete('/{common_media}', 'CommonMedia\CommonMediaController@destroy');
    });

Route::prefix('meta')->group(function () {
        Route::get('/', 'CommonMetum\CommonMetumController@index');
        Route::get('/{common_meta}', 'CommonMetum\CommonMetumController@show');
        Route::post('/', 'CommonMetum\CommonMetumController@store');
        Route::patch('/{common_meta}', 'CommonMetum\CommonMetumController@update');
        Route::delete('/{common_meta}', 'CommonMetum\CommonMetumController@destroy');
    });

Route::prefix('registries')->group(function () {
        Route::get('/', 'CommonRegistry\CommonRegistryController@index');
        Route::get('/{common_registries}', 'CommonRegistry\CommonRegistryController@show');
        Route::post('/', 'CommonRegistry\CommonRegistryController@store');
        Route::patch('/{common_registries}', 'CommonRegistry\CommonRegistryController@update');
        Route::delete('/{common_registries}', 'CommonRegistry\CommonRegistryController@destroy');
    });

Route::prefix('social-media')->group(function () {
        Route::get('/', 'CommonSocialMedia\CommonSocialMediaController@index');
        Route::get('/{common_social_media}', 'CommonSocialMedia\CommonSocialMediaController@show');
        Route::post('/', 'CommonSocialMedia\CommonSocialMediaController@store');
        Route::patch('/{common_social_media}', 'CommonSocialMedia\CommonSocialMediaController@update');
        Route::delete('/{common_social_media}', 'CommonSocialMedia\CommonSocialMediaController@destroy');
    });

Route::prefix('states')->group(function () {
        Route::get('/', 'CommonState\CommonStateController@index');
        Route::get('/{common_states}', 'CommonState\CommonStateController@show');
        Route::post('/', 'CommonState\CommonStateController@store');
        Route::patch('/{common_states}', 'CommonState\CommonStateController@update');
        Route::delete('/{common_states}', 'CommonState\CommonStateController@destroy');
    });

Route::prefix('taggables')->group(function () {
        Route::get('/', 'CommonTaggable\CommonTaggableController@index');
        Route::get('/{common_taggables}', 'CommonTaggable\CommonTaggableController@show');
        Route::post('/', 'CommonTaggable\CommonTaggableController@store');
        Route::patch('/{common_taggables}', 'CommonTaggable\CommonTaggableController@update');
        Route::delete('/{common_taggables}', 'CommonTaggable\CommonTaggableController@destroy');
    });

Route::prefix('tags')->group(function () {
        Route::get('/', 'CommonTag\CommonTagController@index');
        Route::get('/{common_tags}', 'CommonTag\CommonTagController@show');
        Route::post('/', 'CommonTag\CommonTagController@store');
        Route::patch('/{common_tags}', 'CommonTag\CommonTagController@update');
        Route::delete('/{common_tags}', 'CommonTag\CommonTagController@destroy');
    });

Route::prefix('validatable')->group(function () {
        Route::get('/', 'CommonValidatable\CommonValidatableController@index');
        Route::get('/{common_validatable}', 'CommonValidatable\CommonValidatableController@show');
        Route::post('/', 'CommonValidatable\CommonValidatableController@store');
        Route::patch('/{common_validatable}', 'CommonValidatable\CommonValidatableController@update');
        Route::delete('/{common_validatable}', 'CommonValidatable\CommonValidatableController@destroy');
    });

Route::prefix('votes')->group(function () {
        Route::get('/', 'CommonVote\CommonVoteController@index');
        Route::get('/{common_votes}', 'CommonVote\CommonVoteController@show');
        Route::post('/', 'CommonVote\CommonVoteController@store');
        Route::patch('/{common_votes}', 'CommonVote\CommonVoteController@update');
        Route::delete('/{common_votes}', 'CommonVote\CommonVoteController@destroy');
    });

// EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n
});