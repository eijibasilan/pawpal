<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpsertVetAppointmentScheduleRequest;
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
			'pagination' => Inertia::always(Inertia::merge(VetAppointmentSchedule::with(['service', 'doctor'])->paginate(request('perPage', 20), "*", null, request('page', 1)))),
			'vetServices' => Inertia::lazy(fn() => VetService::all()),
			'doctors' => Inertia::lazy(fn() => Admin::whereHas('roles', function ($query) {
				$query->where('name', 'Doctor');
			})->get())
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(UpsertVetAppointmentScheduleRequest $request)
	{
		VetAppointmentSchedule::create($request->all());

		return redirect('/admin/vet-appointment-schedules');
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpsertVetAppointmentScheduleRequest $request, string $id)
	{
		$data = VetAppointmentSchedule::findOrFail($id);
		$data->update($request->all());

		return redirect('/admin/vet-appointment-schedules');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$row = VetAppointmentSchedule::findOrFail($id);
		$row->delete();

		return redirect('/admin/vet-appointment-schedules');
	}
}
