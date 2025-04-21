Route::get('verify-email', EmailVerificationPromptController::class)
->name('user.verification.notice');
<?php

use App\Http\Controllers\Admin\VetAppointmentScheduleController;
use App\Http\Controllers\Admin\VetServiceController;
use App\Http\Controllers\Admin\VetServiceTypeController;
use Illuminate\Support\Facades\Route;

Route::apiResource('vet-services', VetServiceController::class)->except('show');
Route::apiResource('vet-service-types', VetServiceTypeController::class)->except('show');
Route::apiResource('vet-appointment-schedules', VetAppointmentScheduleController::class)->except('show');

Route::delete('/vet-services/image/{id}', [VetServiceController::class, 'deleteImage'])
	->name('vet_service.image.delete');


