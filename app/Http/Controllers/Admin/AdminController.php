<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpsertAdminRequest;
use App\Models\Admin;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

use function Illuminate\Log\log;

class AdminController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		Gate::authorize('viewAny', Admin::class);
		return Inertia::render('admin/Admins', [
			'pagination' => Inertia::always(Inertia::merge(Admin::with('roles')->orderBy(request('sortField', 'created_at'), request('sortDirection', 'desc'))->paginate(request('perPage', 5), "*", null, request('page', 1)))),
			'roles' => Inertia::lazy(fn() => Role::all())
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(UpsertAdminRequest $request)
	{
		Gate::authorize('store', Admin::class);
		DB::transaction(function () use ($request) {
			$data = Admin::create($request->all());
			log($request->roles);
			$data->assignRole($request->roles);
		});
		return redirect('/admin/admins');
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpsertAdminRequest $request, string $id)
	{
		Gate::authorize('update', Admin::class);
		DB::transaction(function () use ($request, $id) {
			$data = Admin::findOrFail($id);
			$data->update($request->all());

			$data->syncRoles($request->roles);
		});
		return redirect('/admin/admins');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		Gate::authorize('delete', Admin::class);
		$row = Admin::findOrFail($id);
		$row->delete();

		return redirect('/admin/admins');
	}
}
