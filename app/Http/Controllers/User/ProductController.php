<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
	public function index()
	{
		return Inertia::render('user/Products', [
			'products' => Product::with('category', 'brand', 'uploads')->get(),
		]);
	}
}
