<?php

use App\Http\Controllers\Admin\VetServiceController;
use App\Http\Controllers\Admin\VetServiceTypeController;
use Illuminate\Support\Facades\Route;

Route::apiResource('vet-services', VetServiceController::class)->except('show');
Route::apiResource('vet-service-types', VetServiceTypeController::class)->except('show');