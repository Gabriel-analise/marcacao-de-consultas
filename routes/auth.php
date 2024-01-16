<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-senha', [PasswordResetLinkController::class, 'create'])
                ->name('senha.request');

    Route::post('forgot-senha', [PasswordResetLinkController::class, 'store'])
                ->name('senha.email');

    Route::get('reset-senha/{token}', [NewPasswordController::class, 'create'])
                ->name('senha.reset');

    Route::post('reset-senha', [NewPasswordController::class, 'store'])
                ->name('senha.store');
});

Route::middleware('auth')->group(function () {

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-senha', [ConfirmablePasswordController::class, 'show'])
                ->name('senha.confirm');

    Route::post('confirm-senha', [ConfirmablePasswordController::class, 'store']);

    Route::put('senha', [PasswordController::class, 'update'])->name('senha.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
