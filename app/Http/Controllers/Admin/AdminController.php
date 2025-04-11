<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpsertAdminRequest;
use App\Models\Admin;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

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
		Role::create($request->all());

		return redirect('/admin/accounts');
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpsertAdminRequest $request, string $id)
	{
		$data = Role::findOrFail($id);
		$data->update($request->all());

		return redirect('/admin/roles');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$row = Role::findOrFail($id);
		$row->delete();

		return redirect('/admin/roles');
	}
}
