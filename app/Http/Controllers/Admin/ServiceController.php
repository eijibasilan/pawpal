<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpsertServiceRequest;
use App\Models\Service;
use Inertia\Inertia;

class ServiceController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		return Inertia::render('admin/Services', [
			'pagination' => Inertia::always(Inertia::merge(Service::paginate(request('perPage', 5), "*", null, request('page', 1)))),
		]);
	}

	public function store(UpsertServiceRequest $request)
	{
		Service::create($request->all());

		return redirect('/admin/services');
	}

	public function update(UpsertServiceRequest $request, string $id)
	{
		$data = Service::findOrFail($id);
		$data->update($request->all());

		return redirect('/admin/services');
	}


	public function destroy(string $id)
	{
		$row = Service::findOrFail($id);
		$row->delete();

		return redirect('/admin/services');
	}
}
