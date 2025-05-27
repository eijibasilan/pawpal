<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::apiResource('products', ProductController::class)->except('show');


Route::delete('/products/image/{id}', [ProductController::class, 'deleteImage'])
	->name('product.image.delete');