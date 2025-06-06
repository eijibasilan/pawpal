<?php

use App\Http\Controllers\User\Settings\PasswordController;
use App\Http\Controllers\User\Settings\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
	Route::redirect('settings', '/settings/profile');

	Route::get('settings/profile', [ProfileController::class, 'edit'])->name('user.profile.edit');
	Route::patch('settings/profile', [ProfileController::class, 'update'])->name('user.profile.update');
	Route::delete('settings/profile', [ProfileController::class, 'destroy'])->name('user.profile.destroy');

	Route::get('settings/password', [PasswordController::class, 'edit'])->name('user.password.edit');
	Route::put('settings/password', [PasswordController::class, 'update'])->name('user.password.update');

	Route::get('settings/appearance', function () {
		return Inertia::render('user/settings/Appearance');
	})->name('user.appearance');
});
