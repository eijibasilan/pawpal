<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guestAdmin')->group(function () {
	Route::get('/', [AuthenticatedSessionController::class, 'index'])
		->name('admin.index');

	Route::post('login', [AuthenticatedSessionController::class, 'store']);

	Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
		->name('admin.password.request');

	Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
		->name('admin.password.email');

	Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
		->name('admin.password.reset');

	Route::post('reset-password', [NewPasswordController::class, 'store'])
		->name('admin.password.store');
});

Route::middleware('auth:admin')->group(function () {
	Route::get('verify-email', EmailVerificationPromptController::class)
		->name('admin.verification.notice');

	Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
		->middleware(['signed', 'throttle:6,1'])
		->name('admin.verification.verify');

	Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
		->middleware('throttle:6,1')
		->name('admin.verification.send');

	Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
		->name('admin.password.confirm');

	Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

	Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
		->name('admin.logout');
});
