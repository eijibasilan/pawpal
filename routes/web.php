<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\User\NotificationController as UserNotificationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ServiceAppointmentController;
use App\Http\Controllers\HotelBookingController;
use App\Http\Controllers\GroomingBookingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Include public routes
require __DIR__ . '/publicRoutes.php';

// User routes
Route::prefix('user')->group(function () {
    require __DIR__ . '/user/auth.php';
    require __DIR__ . '/user/products.php';
    require __DIR__ . '/user/vetServices.php';
    require __DIR__ . '/user/settings.php';
    Route::get('/notifications', [UserNotificationController::class, 'index'])
        ->name('user.notifications');

    Route::middleware(['auth'])->group(function () {
        Route::get('/pet-grooming', function () {
            return Inertia::render('user/PetGrooming');
        })->name('user.pet-grooming');

        Route::get('/dog-grooming', function () {
            return Inertia::render('user/DogGrooming');
        })->name('user.dog-grooming');

        Route::get('/cat-grooming', function () {
            return Inertia::render('user/CatGrooming');
        })->name('user.cat-grooming');

        Route::get('/pet-hotel', function () {
            return Inertia::render('user/PetHotel');
        })->name('user.pet-hotel');

        Route::get('/dog-hotel', function () {
            return Inertia::render('user/DogHotel');
        })->name('user.dog-hotel');

        Route::get('/cat-hotel', function () {
            return Inertia::render('user/CatHotel');
        })->name('user.cat-hotel');

        Route::post('/user/book-hotel', [HotelBookingController::class, 'store'])
            ->name('user.book-hotel');

        Route::post('/user/book-grooming', [GroomingBookingController::class, 'store'])
            ->name('user.book-grooming');
    });
    require __DIR__ . '/user/products.php';
    require __DIR__ . '/user/vetServices.php';
    require __DIR__ . '/user/settings.php';
});

// Admin routes
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

// Chat routes
Route::middleware(['auth'])->group(function () {
    Route::get('/chat/messages', [ChatController::class, 'userMessages']);
    Route::post('/chat/send', [ChatController::class, 'sendMessage']);
});
