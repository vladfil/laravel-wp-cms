<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminPanelController;

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

/**
 * User Controller Routes
 */
Route::get('/register', [UserController::class, 'create'])
    ->middleware('guest');
Route::post('/users', [UserController::class, 'store'])
    ->middleware('guest');

/**
 * Auth Controller Routes
 */
Route::get('/login', [AuthController::class, 'login'])
    ->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/authenticate', [AuthController::class, 'authenticate'])
    ->middleware('guest');

// Email verification
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');
Route::get('/email/verify', [AuthController::class, 'verifyMessage'])
    ->middleware('auth')
    ->name('verification.notice');
Route::post('/email/resend', [AuthController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

// Reset password
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])
    ->middleware('guest')
    ->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'submitResetPassword'])
    ->middleware('guest')
    ->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])
    ->middleware('guest')
    ->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPasswordHandler'])
    ->middleware('guest')
    ->name('password.update');

/**
 * AdminPanelController Routes
 */
Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function () {
    Route::get('/', AdminPanelController::class);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{user}/edit', [UserController::class, 'edit']);
    Route::patch('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
    Route::delete('/users', [UserController::class, 'destroySelected']);
});
