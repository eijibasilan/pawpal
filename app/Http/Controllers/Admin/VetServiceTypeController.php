<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\UpsertVetServiceTypeRequest;
use App\Models\VetService;
use App\Models\VetServiceType;
use Inertia\Inertia;

class VetServiceTypeController extends Controller
{
	public function index()
	{
		Gate::authorize('viewAny', VetServiceType::class);
		return Inertia::render('admin/VetServiceTypes', [
			'pagination' => Inertia::always(Inertia::merge(VetServiceType::with('service')->orderBy(request('sortField', 'created_at'), request('sortDirection', 'desc'))->paginate(request('perPage', 5), "*", null, request('page', 1)))),
			'vetServices' => Inertia::lazy(fn() => VetService::all())
		]);
	}

	public function store(UpsertVetServiceTypeRequest $request)
	{
		Gate::authorize('store', VetServiceType::class);
		VetServiceType::create($request->all());

		return redirect('/admin/vet-service-types');
	}

	public function update(UpsertVetServiceTypeRequest $request, string $id)
	{
		Gate::authorize('update', VetServiceType::class);
		$data = VetServiceType::findOrFail($id);
		$data->update($request->all());

		return redirect('/admin/vet-service-types');
	}

	public function destroy(string $id)
	{
		Gate::authorize('delete', VetServiceType::class);
		$row = VetServiceType::findOrFail($id);
		$row->delete();

		return redirect('/admin/vet-service-types');
	}
}
