<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpsertProductRequest;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\Upload;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
	public function index()
	{
		Gate::authorize('index', Product::class);
		return Inertia::render('admin/Products', [
			'pagination' => Inertia::always(Inertia::merge(Product::with(['uploads', 'category', 'brand'])->orderBy(request('sortField', 'created_at'), request('sortDirection', 'desc'))->paginate(request('perPage', 5), "*", null, request('page', 1)))),
			'productBrands' => Inertia::lazy(fn() => ProductBrand::all()),
			'productCategories' => Inertia::lazy(fn() => ProductCategory::all())
		]);
	}

	public function store(UpsertProductRequest $request)
	{
		Gate::authorize('store', Product::class);
		DB::transaction(function () use ($request) {
			$product = Product::create($request->all());

			$index = 1;
			foreach ($request->images as $image) {
				$fileDirectory = "storage/products/";
				$fileName = now()->format('M-d-Y_H-i-s') . '_' . $index . '.' . $image->extension();
				$image->storeAs("products/", $fileName, 'public');

				$product->uploads()->create([
					'file_name' => $fileName,
					'file_extension' => $image->getMimeType(),
					'url' => $fileDirectory . $fileName
				]);
				$index += 1;
			}
		});
		return redirect('/admin/products');
	}

	public function update(UpsertProductRequest $request, string $id)
	{
		Gate::authorize('update', Product::class);
		DB::transaction(function () use ($id, $request) {
			$data = Product::findOrFail($id);
			$data->update($request->all());

			$index = 1;
			foreach ($request->images as $image) {
				$fileDirectory = "storage/vet_services/";
				$fileName = now()->format('M-d-Y_H-i-s') . '_' . $index . '.' . $image->extension();
				$image->storeAs("vet_services/", $fileName, 'public');

				$data->uploads()->create([
					'file_name' => $fileName,
					'file_extension' => $image->getMimeType(),
					'url' => $fileDirectory . $fileName
				]);
				$index += 1;
			}

		});
		return redirect('/admin/products');
	}

	public function destroy(string $id)
	{
		Gate::authorize('delete', Product::class);
		$row = Product::findOrFail($id);
		$row->delete();

		return redirect('/admin/products');
	}

	public function deleteImage(string $id)
	{
		Gate::authorize('delete', Product::class);
		DB::transaction(function () use ($id, ) {
			$file = Upload::findOrFail($id);
			Storage::disk('public')->delete('products/' . $file->file_name);
			$file->delete();
		});

		return redirect('/admin/products');
	}
}
