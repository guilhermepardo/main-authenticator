<?php

use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {

    Route::post('/create', 'App\Http\Controllers\User\UserController@store')->name('user.create');

});

Route::prefix('auth')->group(function () {

    Route::post('/login', 'App\Http\Controllers\Auth\AuthController@login')->name('auth.login');

});
