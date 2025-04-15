<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpsertVetServiceTypeRequest;
use App\Models\VetService;
use App\Models\VetServiceType;
use Inertia\Inertia;

class VetServiceTypeController extends Controller
{
	public function index()
	{
		return Inertia::render('admin/VetServiceTypes', [
			'pagination' => Inertia::always(Inertia::merge(VetServiceType::with('service')->paginate(request('perPage', 5), "*", null, request('page', 1)))),
			'vetServices' => Inertia::lazy(fn() => VetService::all())
		]);
	}

	public function store(UpsertVetServiceTypeRequest $request)
	{
		VetServiceType::create($request->all());

		return redirect('/admin/vet-service-types');
	}

	public function update(UpsertVetServiceTypeRequest $request, string $id)
	{
		$data = VetServiceType::findOrFail($id);
		$data->update($request->all());

		return redirect('/admin/vet-service-types');
	}

	public function destroy(string $id)
	{
		$row = VetServiceType::findOrFail($id);
		$row->delete();

		return redirect('/admin/vet-service-types');
	}
}
