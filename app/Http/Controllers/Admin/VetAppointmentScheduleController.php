<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\VetAppointmentSchedule;
use App\Models\VetService;
use Inertia\Inertia;

class VetAppointmentScheduleController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		return Inertia::render('admin/VetAppointmentSchedules', [
			'pagination' => Inertia::always(Inertia::merge(VetAppointmentSchedule::with('category')->paginate(request('perPage', 5), "*", null, request('page', 1)))),
			'vetServices' => Inertia::lazy(fn() => VetService::all()),
			'doctors' => Inertia::always(fn() => Admin::with('roles')->get()->filter(
				fn($admin) => $admin->roles->where('name', 'Doctor')->toArray()
			))
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		//
	}
}
