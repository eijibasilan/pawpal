<?php

use App\Http\Controllers\Admin\VetServiceController;
use Illuminate\Support\Facades\Route;

Route::apiResource('vet-services', VetServiceController::class)->except('show');