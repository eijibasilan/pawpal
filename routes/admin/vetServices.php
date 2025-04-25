<?php

use App\Http\Controllers\Admin\VetAppointmentController;
use App\Http\Controllers\Admin\VetAppointmentScheduleController;
use App\Http\Controllers\Admin\VetServiceController;
use App\Http\Controllers\Admin\VetServiceTypeController;
use Illuminate\Support\Facades\Route;

Route::apiResource('vet-services', VetServiceController::class)->except('show');
Route::apiResource('vet-service-types', VetServiceTypeController::class)->except('show');
Route::apiResource('vet-appointment-schedules', VetAppointmentScheduleController::class)->except('show');
Route::apiResource('vet-appointments', VetAppointmentController::class)->only(['index', 'update']);

Route::patch('/vet-appointments/approve/{id}', [VetAppointmentController::class, 'approveVetAppointment'])
	->name('vet_appointments.status.approve');

Route::delete('/vet-services/image/{id}', [VetServiceController::class, 'deleteImage'])
	->name('vet_service.image.delete');


