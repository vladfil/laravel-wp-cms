<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmailVerifyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

// User
Route::get('/login', [UserController::class, 'login']);
Route::get('/register', [UserController::class, 'create']);
Route::get('/restore', [UserController::class, 'restore']);
Route::post('/users', [UserController::class, 'store']);
Route::post('/authenticate', [UserController::class, 'authenticate']);

Route::get('/email/verify/{id}/{hash}', [EmailVerifyController::class, 'verify'])
    ->middleware(['auth', 'signed'])->name('verification.verify');
Route::get('/email/verify', [EmailVerifyController::class, 'verifyMessage'])
    ->middleware('auth')->name('verification.notice');
Route::post('/email/resend', [EmailVerifyController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])->name('verification.send');
