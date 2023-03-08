<?php

Route::prefix('commons')->group(function() {
    Route::prefix('country')->group(function () {
        Route::get('/', 'Country\CountryController@index');
        Route::get('/{country}', 'Country\CountryController@show');
        Route::post('/', 'Country\CountryController@store');
        Route::put('/{country}', 'Country\CountryController@update');
        Route::delete('/{country}', 'Country\CountryController@destroy');
    });

//!APPENDHERE
});