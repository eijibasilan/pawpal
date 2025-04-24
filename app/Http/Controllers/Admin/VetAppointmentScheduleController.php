<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpsertVetAppointmentScheduleRequest;
use App\Models\Admin;
use App\Models\VetAppointmentSchedule;
use App\Models\VetService;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class VetAppointmentScheduleController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		Gate::authorize('viewAny', VetAppointmentSchedule::class);
		return Inertia::render('admin/VetAppointmentSchedules', [
			'pagination' => Inertia::always(Inertia::merge(VetAppointmentSchedule::with(['service', 'doctor'])->orderBy(request('sortField', 'created_at'), request('sortDirection', 'desc'))->paginate(request('perPage', 5), "*", null, request('page', 1)))),
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
		Gate::authorize('store', VetAppointmentSchedule::class);
		VetAppointmentSchedule::create($request->all());

		return redirect('/admin/vet-appointment-schedules');
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpsertVetAppointmentScheduleRequest $request, string $id)
	{
		Gate::authorize('update', VetAppointmentSchedule::class);
		$data = VetAppointmentSchedule::findOrFail($id);
		$data->update($request->all());

		return redirect('/admin/vet-appointment-schedules');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		Gate::authorize('delete', VetAppointmentSchedule::class);
		$row = VetAppointmentSchedule::findOrFail($id);
		$row->delete();

		return redirect('/admin/vet-appointment-schedules');
	}
}
