<?php

use Illuminate\Support\Facades\Route;


Route::auth();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'AppController@index');
    Route::get('/system/translations/{language}', 'TranslationController@system');

    Route::group(['prefix' => 'translations'], function () {
        Route::get('/', 'TranslationController@index');
        Route::post('/', 'TranslationController@store');
    });

    Route::resource('languages', 'LanguageController', ['except' => ['create', 'edit']]);
});
