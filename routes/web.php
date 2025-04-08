<?php

use App\Http\Controllers\User\ServiceController as UserServiceController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
	return Inertia::render('Welcome');
})->name('home');


Route::prefix('user')->group(function () {
	Route::get('dashboard', function () {
		return Inertia::render('user/Dashboard');
	})->middleware(['auth', 'verified'])->name('user.dashboard');

	Route::prefix('services')->group(function () {
		Route::get('/', [UserServiceController::class, 'index'])->name('user.services');
	});

	require __DIR__ . '/user/auth.php';
	require __DIR__ . '/user/settings.php';
});


Route::prefix('admin')->group(function () {
	Route::get('dashboard', function () {
		return Inertia::render('admin/Dashboard');
	})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

	require __DIR__ . '/admin/auth.php';
	require __DIR__ . '/admin/settings.php';
});