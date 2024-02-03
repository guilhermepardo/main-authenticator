<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/user/create', 'App\Http\Controllers\User\UserController@store');

