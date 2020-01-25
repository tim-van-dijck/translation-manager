<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'translations'], function () {
    Route::get('/', 'TranslationController@index');
    Route::post('/', 'TranslationController@store');
});