<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpsertVetServiceRequest;
use App\Models\Upload;
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
		return Inertia::render('admin/VetServices', [
			'pagination' => Inertia::always(Inertia::merge(VetService::with('uploads', 'types')->orderBy(request('sortField', 'created_at'), request('sortDirection', 'desc'))->paginate(request('perPage', 5), "*", null, request('page', 1)))),
		]);
	}

	public function store(UpsertVetServiceRequest $request)
	{
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
		$row = VetService::findOrFail($id);
		$row->delete();

		return redirect('/admin/vet-services');
	}

	public function deleteImage(string $id)
	{
		DB::transaction(function () use ($id, ) {
			$file = Upload::findOrFail($id);
			Storage::disk('public')->delete('vet_services/' . $file->file_name);
			$file->delete();
		});

		return redirect('/admin/vet-services');
	}
}
