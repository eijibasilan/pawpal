<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpsertRoleRequest;
use Inertia\Inertia;

use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

	public function index()
	{
		return Inertia::render('admin/Roles', [
			'pagination' => Inertia::always(Inertia::merge(Role::paginate(request('perPage', 20), "*", null, request('page', 1)))),
		]);
	}


	public function store(UpsertRoleRequest $request)
	{
		Role::create($request->all());

		return redirect('/admin/roles');
	}

	public function update(UpsertRoleRequest $request, string $id)
	{
		$data = Role::findOrFail($id);
		$data->update($request->all());

		return redirect('/admin/roles');
	}

	public function destroy(string $id)
	{
		$row = Role::findOrFail($id);
		$row->delete();

		return redirect('/admin/roles');
	}
}
