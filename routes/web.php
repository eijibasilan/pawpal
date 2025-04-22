<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

require __DIR__ . '/publicRoutes.php';

Route::prefix('user')->group(function () {
	Route::get('dashboard', function () {
		return Inertia::render('user/Dashboard');
	})->middleware(['auth', 'verified'])->name('user.dashboard');

	require __DIR__ . '/user/vetServices.php';
	require __DIR__ . '/user/auth.php';
	require __DIR__ . '/user/settings.php';
});

Route::prefix('admin')->group(function () {
	Route::get('dashboard', function () {
		return Inertia::render('admin/Dashboard');
	})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

	require __DIR__ . '/admin/auth.php';

	Route::middleware('auth:admin')->group(function () {
		Route::apiResource('roles', RoleController::class)->except('show');
		Route::apiResource('accounts', AdminController::class)->except('show');

		require __DIR__ . '/admin/vetServices.php';
		require __DIR__ . '/admin/settings.php';
		require __DIR__ . '/admin/inventory.php';
	});
});
