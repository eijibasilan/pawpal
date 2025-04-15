<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpsertAdminRequest;
use App\Models\Admin;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

use function Illuminate\Log\log;

class AdminController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		return Inertia::render('admin/Accounts', [
			'pagination' => Inertia::always(Inertia::merge(Admin::with('roles')->paginate(request('perPage', 5), "*", null, request('page', 1)))),
			'roles' => Inertia::lazy(fn() => Role::all())
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(UpsertAdminRequest $request)
	{
		DB::transaction(function () use ($request) {
			$data = Admin::create($request->all());
			log($request->roles);
			$data->assignRole($request->roles);
		});
		return redirect('/admin/accounts');
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpsertAdminRequest $request, string $id)
	{
		DB::transaction(function () use ($request, $id) {
			$data = Admin::findOrFail($id);
			$data->update($request->all());

			$data->syncRoles($request->roles);
		});
		return redirect('/admin/accounts');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$row = Admin::findOrFail($id);
		$row->delete();

		return redirect('/admin/accounts');
	}
}
