<?php

Route::prefix('commons')->group(function() {
Route::prefix('addresses')->group(function () {
        Route::get('/', 'CommonAddress\CommonAddressController@index');
        Route::get('/{common-addresses}', 'CommonAddress\CommonAddressController@show');
        Route::post('/', 'CommonAddress\CommonAddressController@store');
        Route::put('/{common-addresses}', 'CommonAddress\CommonAddressController@update');
        Route::delete('/{common-addresses}', 'CommonAddress\CommonAddressController@destroy');
    });

Route::prefix('categories')->group(function () {
        Route::get('/', 'CommonCategory\CommonCategoryController@index');
        Route::get('/{common-categories}', 'CommonCategory\CommonCategoryController@show');
        Route::post('/', 'CommonCategory\CommonCategoryController@store');
        Route::put('/{common-categories}', 'CommonCategory\CommonCategoryController@update');
        Route::delete('/{common-categories}', 'CommonCategory\CommonCategoryController@destroy');
    });

Route::prefix('comments')->group(function () {
        Route::get('/', 'CommonComment\CommonCommentController@index');
        Route::get('/{common-comments}', 'CommonComment\CommonCommentController@show');
        Route::post('/', 'CommonComment\CommonCommentController@store');
        Route::put('/{common-comments}', 'CommonComment\CommonCommentController@update');
        Route::delete('/{common-comments}', 'CommonComment\CommonCommentController@destroy');
    });

Route::prefix('countries')->group(function () {
        Route::get('/', 'CommonCountry\CommonCountryController@index');
        Route::get('/{common-countries}', 'CommonCountry\CommonCountryController@show');
        Route::post('/', 'CommonCountry\CommonCountryController@store');
        Route::put('/{common-countries}', 'CommonCountry\CommonCountryController@update');
        Route::delete('/{common-countries}', 'CommonCountry\CommonCountryController@destroy');
    });

Route::prefix('credit-cards')->group(function () {
        Route::get('/', 'CommonCreditCard\CommonCreditCardController@index');
        Route::get('/{common-credit-cards}', 'CommonCreditCard\CommonCreditCardController@show');
        Route::post('/', 'CommonCreditCard\CommonCreditCardController@store');
        Route::put('/{common-credit-cards}', 'CommonCreditCard\CommonCreditCardController@update');
        Route::delete('/{common-credit-cards}', 'CommonCreditCard\CommonCreditCardController@destroy');
    });

Route::prefix('disposable-emails')->group(function () {
        Route::get('/', 'CommonDisposableEmail\CommonDisposableEmailController@index');
        Route::get('/{common-disposable-emails}', 'CommonDisposableEmail\CommonDisposableEmailController@show');
        Route::post('/', 'CommonDisposableEmail\CommonDisposableEmailController@store');
        Route::put('/{common-disposable-emails}', 'CommonDisposableEmail\CommonDisposableEmailController@update');
        Route::delete('/{common-disposable-emails}', 'CommonDisposableEmail\CommonDisposableEmailController@destroy');
    });

Route::prefix('domains')->group(function () {
        Route::get('/', 'CommonDomain\CommonDomainController@index');
        Route::get('/{common-domains}', 'CommonDomain\CommonDomainController@show');
        Route::post('/', 'CommonDomain\CommonDomainController@store');
        Route::put('/{common-domains}', 'CommonDomain\CommonDomainController@update');
        Route::delete('/{common-domains}', 'CommonDomain\CommonDomainController@destroy');
    });

Route::prefix('exchange-rates')->group(function () {
        Route::get('/', 'CommonExchangeRate\CommonExchangeRateController@index');
        Route::get('/{common-exchange-rates}', 'CommonExchangeRate\CommonExchangeRateController@show');
        Route::post('/', 'CommonExchangeRate\CommonExchangeRateController@store');
        Route::put('/{common-exchange-rates}', 'CommonExchangeRate\CommonExchangeRateController@update');
        Route::delete('/{common-exchange-rates}', 'CommonExchangeRate\CommonExchangeRateController@destroy');
    });

Route::prefix('languages')->group(function () {
        Route::get('/', 'CommonLanguage\CommonLanguageController@index');
        Route::get('/{common-languages}', 'CommonLanguage\CommonLanguageController@show');
        Route::post('/', 'CommonLanguage\CommonLanguageController@store');
        Route::put('/{common-languages}', 'CommonLanguage\CommonLanguageController@update');
        Route::delete('/{common-languages}', 'CommonLanguage\CommonLanguageController@destroy');
    });

Route::prefix('media')->group(function () {
        Route::get('/', 'CommonMedia\CommonMediaController@index');
        Route::get('/{common-media}', 'CommonMedia\CommonMediaController@show');
        Route::post('/', 'CommonMedia\CommonMediaController@store');
        Route::put('/{common-media}', 'CommonMedia\CommonMediaController@update');
        Route::delete('/{common-media}', 'CommonMedia\CommonMediaController@destroy');
    });

Route::prefix('meta')->group(function () {
        Route::get('/', 'CommonMetum\CommonMetumController@index');
        Route::get('/{common-meta}', 'CommonMetum\CommonMetumController@show');
        Route::post('/', 'CommonMetum\CommonMetumController@store');
        Route::put('/{common-meta}', 'CommonMetum\CommonMetumController@update');
        Route::delete('/{common-meta}', 'CommonMetum\CommonMetumController@destroy');
    });

Route::prefix('registries')->group(function () {
        Route::get('/', 'CommonRegistry\CommonRegistryController@index');
        Route::get('/{common-registries}', 'CommonRegistry\CommonRegistryController@show');
        Route::post('/', 'CommonRegistry\CommonRegistryController@store');
        Route::put('/{common-registries}', 'CommonRegistry\CommonRegistryController@update');
        Route::delete('/{common-registries}', 'CommonRegistry\CommonRegistryController@destroy');
    });

Route::prefix('states')->group(function () {
        Route::get('/', 'CommonState\CommonStateController@index');
        Route::get('/{common-states}', 'CommonState\CommonStateController@show');
        Route::post('/', 'CommonState\CommonStateController@store');
        Route::put('/{common-states}', 'CommonState\CommonStateController@update');
        Route::delete('/{common-states}', 'CommonState\CommonStateController@destroy');
    });

Route::prefix('tags')->group(function () {
        Route::get('/', 'CommonTag\CommonTagController@index');
        Route::get('/{common-tags}', 'CommonTag\CommonTagController@show');
        Route::post('/', 'CommonTag\CommonTagController@store');
        Route::put('/{common-tags}', 'CommonTag\CommonTagController@update');
        Route::delete('/{common-tags}', 'CommonTag\CommonTagController@destroy');
    });

Route::prefix('votes')->group(function () {
        Route::get('/', 'CommonVote\CommonVoteController@index');
        Route::get('/{common-votes}', 'CommonVote\CommonVoteController@show');
        Route::post('/', 'CommonVote\CommonVoteController@store');
        Route::put('/{common-votes}', 'CommonVote\CommonVoteController@update');
        Route::delete('/{common-votes}', 'CommonVote\CommonVoteController@destroy');
    });

// EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
});