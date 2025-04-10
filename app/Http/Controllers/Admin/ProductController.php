<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpsertProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
	public function index(Request $request)
	{

		return Inertia::render('admin/Products', [
			'pagination' => Inertia::always(Inertia::merge(Product::with('category')->paginate(request('perPage', 5), "*", null, request('page', 1)))),
			'productCategories' => Inertia::lazy(fn() => ProductCategory::all())
		]);
	}

	public function store(UpsertProductRequest $request)
	{
		Product::create($request->all());

		return redirect('/admin/products');
	}

	public function update(UpsertProductRequest $request, string $id)
	{
		$data = Product::findOrFail($id);
		$data->update($request->all());

		return redirect('/admin/products');
	}

	public function destroy(string $id)
	{
		$row = Product::findOrFail($id);
		$row->delete();

		return redirect('/admin/products');
	}
}
