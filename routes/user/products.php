<?php
use App\Http\Controllers\User\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/products', [ProductController::class, 'index'])
	->name('user.products');