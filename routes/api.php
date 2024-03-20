<?php

use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {

    Route::post('/create', 'App\Http\Controllers\User\UserController@store');

});
