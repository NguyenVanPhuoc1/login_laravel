<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\Auth\PasswordAuthController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'viewHome'])->name('home');

Route::middleware('guest')->group(function () {

    Route::get('register', [CustomAuthController::class, 'createRegister'])
        ->name('register');

    Route::post('register', [CustomAuthController::class, 'register'])
    ->name('users.register');;

    Route::get('login', [CustomAuthController::class, 'createLogin'])
        ->name('login');

    Route::post('login', [CustomAuthController::class, 'login'])
    ->name('login.custom');

    Route::get('forgot-password', [PasswordAuthController::class, 'viewForgetPassword'])
    ->name('password.request');

    Route::post('forgot-password', [PasswordAuthController::class, 'sendMailResetPassword'])
        ->name('password.email');

    Route::get('reset-password/{token}', [PasswordAuthController::class, 'viewResetPassword'])
        ->name('password.reset');

    Route::post('reset-password', [PasswordAuthController::class, 'resetPassword'])
        ->name('password.store');
});

Route::middleware(['auth','auth.access'])->group(function () {
    // Admin trang chủ
    Route::get('/admin/trang-chu', [DashboardController::class, 'viewChart'])->name('admin.dashboard');
});
