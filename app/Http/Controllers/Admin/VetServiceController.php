<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpsertVetServiceRequest;
use App\Models\VetService;
use Inertia\Inertia;

class VetServiceController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		return Inertia::render('admin/VetServices', [
			'pagination' => Inertia::always(Inertia::merge(VetService::with('types')->paginate(request('perPage', 5), "*", null, request('page', 1)))),
		]);
	}

	public function store(UpsertVetServiceRequest $request)
	{
		VetService::create($request->all());

		return redirect('/admin/vet-services');
	}

	public function update(UpsertVetServiceRequest $request, string $id)
	{
		$data = VetService::findOrFail($id);
		$data->update($request->all());

		return redirect('/admin/vet-services');
	}


	public function destroy(string $id)
	{
		$row = VetService::findOrFail($id);
		$row->delete();

		return redirect('/admin/vet-services');
	}
}
