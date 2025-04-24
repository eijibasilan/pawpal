<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateVetAppointmentRequest;
use App\Models\VetAppointment;

class VetAppointmentController extends Controller
{
	public function index()
	{
		$vetAppointments = VetAppointment::with(['schedule.doctor', 'schedule.service', 'user', 'upload'])->whereHas('schedule', function ($query) {
			$query->where('doctor_id', auth('admin')->user()->id);
		})->orderBy(request('sortField', 'created_at'), request('sortDirection', 'desc'))->paginate(request('perPage', 5), "*", null, request('page', 1));

		return Inertia::render('admin/VetAppointments', [
			'pagination' => Inertia::always(Inertia::merge($vetAppointments)),
		]);
	}

	public function update(UpdateVetAppointmentRequest $request, string $id)
	{
		$data = VetAppointment::whereHas('schedule', function ($query) {
			$query->where('doctor_id', auth('admin')->user()->id);
		})->where('id', $id)->first();

		$data->update($request->all());

		return redirect('/admin/vet-appointments');


	}
}
