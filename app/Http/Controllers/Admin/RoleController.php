<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\UpsertRoleRequest;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

	public function index()
	{
		Gate::authorize('viewAny', Role::class);
		return Inertia::render('admin/Roles', [
			'pagination' => Inertia::always(Inertia::merge(Role::orderBy(request('sortField', 'created_at'), request('sortDirection', 'desc'))->paginate(request('perPage', 5), "*", null, request('page', 1)))),
		]);
	}


	public function store(UpsertRoleRequest $request)
	{
		Gate::authorize('store', Role::class);

		Role::create($request->all());
		return redirect('/admin/roles');
	}

	public function update(UpsertRoleRequest $request, string $id)
	{
		Gate::authorize('update', Role::class);
		$data = Role::findOrFail($id);
		$data->update($request->all());

		return redirect('/admin/roles');
	}

	public function destroy(string $id)
	{
		Gate::authorize('delete', Role::class);
		$row = Role::findOrFail($id);
		$row->delete();

		return redirect('/admin/roles');
	}
}
