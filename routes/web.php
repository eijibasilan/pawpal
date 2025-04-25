<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\User\NotificationController as UserNotificationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

require __DIR__ . '/publicRoutes.php';

Route::prefix('user')->group(function () {
	Route::get('/notifications', [UserNotificationController::class, 'index'])
		->name('user.notifications');

	require __DIR__ . '/user/products.php';
	require __DIR__ . '/user/vetServices.php';
	require __DIR__ . '/user/auth.php';
	require __DIR__ . '/user/settings.php';
});

Route::prefix('admin')->group(function () {

	require __DIR__ . '/admin/auth.php';

	Route::middleware('auth:admin')->group(function () {
		Route::get('/dashboard', function () {
			return Inertia::render('admin/Dashboard');
		})->name('admin.dashboard');

		Route::get('/notifications', [AdminNotificationController::class, 'index'])
			->name('admin.notifications');


		Route::apiResource('roles', RoleController::class)->except('show');
		Route::apiResource('admins', AdminController::class)->except('show');
		Route::apiResource('users', UserController::class)->only('index');

		require __DIR__ . '/admin/vetServices.php';
		require __DIR__ . '/admin/settings.php';
		require __DIR__ . '/admin/inventory.php';
	});
});
