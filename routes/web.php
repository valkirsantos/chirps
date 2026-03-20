<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChirpController;

/*
Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('/', function () {
    return view('home');
});
*/

Route::get('/', [ChirpController::class, 'index']);