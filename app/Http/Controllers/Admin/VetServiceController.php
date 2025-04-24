<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpsertVetServiceRequest;
use App\Models\Upload;
use Illuminate\Support\Facades\Gate;
use App\Models\VetService;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class VetServiceController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		Gate::authorize('viewAny', VetService::class);
		return Inertia::render('admin/VetServices', [
			'pagination' => Inertia::always(Inertia::merge(VetService::with('uploads', 'types')->orderBy(request('sortField', 'created_at'), request('sortDirection', 'desc'))->paginate(request('perPage', 5), "*", null, request('page', 1)))),
		]);
	}

	public function store(UpsertVetServiceRequest $request)
	{
		Gate::authorize('store', VetService::class);
		DB::transaction(function () use ($request) {
			$vetService = VetService::create($request->all());

			$index = 1;
			foreach ($request->images as $image) {
				$fileDirectory = "storage/vet_services/";
				$fileName = now()->format('M-d-Y_H-i-s') . '_' . $index . '.' . $image->extension();
				$image->storeAs("vet_services/", $fileName, 'public');

				$vetService->uploads()->create([
					'file_name' => $fileName,
					'file_extension' => $image->getMimeType(),
					'url' => $fileDirectory . $fileName
				]);
				$index += 1;
			}
		});


		return redirect('/admin/vet-services');
	}

	public function update(UpsertVetServiceRequest $request, string $id)
	{
		Gate::authorize('update', VetService::class);
		DB::transaction(function () use ($id, $request) {
			$data = VetService::findOrFail($id);
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

		return redirect('/admin/vet-services');
	}


	public function destroy(string $id)
	{
		Gate::authorize('delete', VetService::class);
		$row = VetService::findOrFail($id);
		$row->delete();

		return redirect('/admin/vet-services');
	}

	public function deleteImage(string $id)
	{
		Gate::authorize('delete', VetService::class);
		DB::transaction(function () use ($id, ) {
			$file = Upload::findOrFail($id);
			Storage::disk('public')->delete('vet_services/' . $file->file_name);
			$file->delete();
		});

		return redirect('/admin/vet-services');
	}
}
