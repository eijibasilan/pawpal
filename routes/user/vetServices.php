<?php

use App\Http\Controllers\User\VetAppointmentController;
use App\Http\Controllers\User\VetServiceController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
	Route::prefix('vet-services')->group(function () {
		Route::get('/', [VetServiceController::class, 'index'])->name('user.services');
	});

	Route::apiResource('vet-appointments', VetAppointmentController::class)->only('index', 'store');
});
