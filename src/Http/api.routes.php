<?php

Route::prefix('commons')->group(function() {
Route::prefix('domains')->group(function () {
        Route::get('/', 'CommonDomain\CommonDomainController@index');
        Route::get('/{common_domains}', 'CommonDomain\CommonDomainController@show');
        Route::post('/', 'CommonDomain\CommonDomainController@store');
        Route::put('/{common_domains}', 'CommonDomain\CommonDomainController@update');
        Route::delete('/{common_domains}', 'CommonDomain\CommonDomainController@destroy');
    });

// EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
});