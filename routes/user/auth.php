<?php

use App\Http\Controllers\User\Auth\AuthenticatedSessionController;
use App\Http\Controllers\User\Auth\ConfirmablePasswordController;
use App\Http\Controllers\User\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\User\Auth\EmailVerificationPromptController;
use App\Http\Controllers\User\Auth\NewPasswordController;
use App\Http\Controllers\User\Auth\PasswordResetLinkController;
use App\Http\Controllers\User\Auth\RegisteredUserController;
use App\Http\Controllers\User\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
	Route::get('register', [RegisteredUserController::class, 'create'])
		->name('register');

	Route::post('register', [RegisteredUserController::class, 'store']);

	Route::get('login', [AuthenticatedSessionController::class, 'create'])
		->name('user.login');

	Route::post('login', [AuthenticatedSessionController::class, 'store']);

	Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
		->name('user.password.request');

	Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
		->name('user.password.email');

	Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
		->name('user.password.reset');

	Route::post('reset-password', [NewPasswordController::class, 'store'])
		->name('user.password.store');
});

Route::middleware('auth')->group(function () {
	Route::get('verify-email', EmailVerificationPromptController::class)
		->name('user.verification.notice');

	Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
		->middleware(['signed', 'throttle:6,1'])
		->name('user.verification.verify');

	Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
		->middleware('throttle:6,1')
		->name('user.verification.send');

	Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
		->name('user.password.confirm');

	Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

	Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
		->name('user.logout');
});
