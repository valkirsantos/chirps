<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\Auth\Register;

/*
Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('/', function () {
    return view('home');
});
*/

//Route::get('/', [ChirpController::class, 'index']);
//Route::post('/chirps', [ChirpController::class, 'store']);
//Route::get('/chirps/{chirp}/edit', [ChirpController::class, 'edit']);
//Route::put('/chirps/{chirp}', [ChirpController::class, 'update']);
//Route::delete('/chirps/{chirp}', [ChirpController::class, 'destroy']);

/*
Route::get('/', [ChirpController::class, 'index']);
Route::resource('chirps', ChirpController::class)
->only(['store', 'edit', 'update', 'destroy']);

Route::view('/register', 'auth.register')
->middleware('guest')
->name('register');
Route::post('/register', Register::class)
->middleware('guest');
*/

Route::view('/register', 'auth.register')
->middleware('guest')
->name('register');
Route::post('/register', Register::class)
->middleware('guest');

Route::get('/', [ChirpController::class, 'index']);
// Protected routes
Route::middleware('auth')->group(function () {
Route::post('/chirps', [ChirpController::class, 'store']);
Route::get('/chirps/{chirp}/edit', [ChirpController::class, 'edit']);
Route::put('/chirps/{chirp}', [ChirpController::class, 'update']);
Route::delete('/chirps/{chirp}', [ChirpController::class, 'destroy']);
});