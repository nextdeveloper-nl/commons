<?php

Route::get('/', function () {
    return [
        'application'   => env('APP_NAME'),
        'health'        => 'ok',
    ];
});