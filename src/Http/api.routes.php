<?php

Route::prefix('commons')->group(function() {
Route::prefix('categories')->group(function () {
        Route::get('/', 'categories\categoriesController@index');
        Route::get('/{categories}', 'categories\categoriesController@show');
        Route::post('/', 'categories\categoriesController@store');
        Route::put('/{categories}', 'categories\categoriesController@update');
        Route::delete('/{categories}', 'categories\categoriesController@destroy');
    });

Route::prefix('countries')->group(function () {
        Route::get('/', 'countries\countriesController@index');
        Route::get('/{countries}', 'countries\countriesController@show');
        Route::post('/', 'countries\countriesController@store');
        Route::put('/{countries}', 'countries\countriesController@update');
        Route::delete('/{countries}', 'countries\countriesController@destroy');
    });

Route::prefix('disposable-emails')->group(function () {
        Route::get('/', 'disposable-emails\disposable-emailsController@index');
        Route::get('/{disposable-emails}', 'disposable-emails\disposable-emailsController@show');
        Route::post('/', 'disposable-emails\disposable-emailsController@store');
        Route::put('/{disposable-emails}', 'disposable-emails\disposable-emailsController@update');
        Route::delete('/{disposable-emails}', 'disposable-emails\disposable-emailsController@destroy');
    });

Route::prefix('exchange-rates')->group(function () {
        Route::get('/', 'exchange-rates\exchange-ratesController@index');
        Route::get('/{exchange-rates}', 'exchange-rates\exchange-ratesController@show');
        Route::post('/', 'exchange-rates\exchange-ratesController@store');
        Route::put('/{exchange-rates}', 'exchange-rates\exchange-ratesController@update');
        Route::delete('/{exchange-rates}', 'exchange-rates\exchange-ratesController@destroy');
    });

Route::prefix('languages')->group(function () {
        Route::get('/', 'languages\languagesController@index');
        Route::get('/{languages}', 'languages\languagesController@show');
        Route::post('/', 'languages\languagesController@store');
        Route::put('/{languages}', 'languages\languagesController@update');
        Route::delete('/{languages}', 'languages\languagesController@destroy');
    });

Route::prefix('media')->group(function () {
        Route::get('/', 'media\mediaController@index');
        Route::get('/{media}', 'media\mediaController@show');
        Route::post('/', 'media\mediaController@store');
        Route::put('/{media}', 'media\mediaController@update');
        Route::delete('/{media}', 'media\mediaController@destroy');
    });

Route::prefix('states')->group(function () {
        Route::get('/', 'states\statesController@index');
        Route::get('/{states}', 'states\statesController@show');
        Route::post('/', 'states\statesController@store');
        Route::put('/{states}', 'states\statesController@update');
        Route::delete('/{states}', 'states\statesController@destroy');
    });

Route::prefix('tags')->group(function () {
        Route::get('/', 'tags\tagsController@index');
        Route::get('/{tags}', 'tags\tagsController@show');
        Route::post('/', 'tags\tagsController@store');
        Route::put('/{tags}', 'tags\tagsController@update');
        Route::delete('/{tags}', 'tags\tagsController@destroy');
    });

Route::prefix('votes')->group(function () {
        Route::get('/', 'votes\votesController@index');
        Route::get('/{votes}', 'votes\votesController@show');
        Route::post('/', 'votes\votesController@store');
        Route::put('/{votes}', 'votes\votesController@update');
        Route::delete('/{votes}', 'votes\votesController@destroy');
    });

// EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
});