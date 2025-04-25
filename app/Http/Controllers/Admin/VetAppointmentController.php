<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\UpdateVetAppointmentRequest;
use App\Models\VetAppointment;

class VetAppointmentController extends Controller
{
	public function index()
	{
		Gate::authorize('viewAny', VetAppointment::class);
		$vetAppointments = VetAppointment::with(['schedule.doctor', 'schedule.service', 'user', 'upload']);

		if (!auth('admin')->user()->hasAnyRole('Business Admin', 'Admin')) {
			$vetAppointments = $vetAppointments->whereHas('schedule', function ($query) {
				$query->where('doctor_id', auth('admin')->user()->id);
			});
		}

		if (request('status') !== null) {
			$vetAppointments = $vetAppointments->where('status', request('status'));
		}

		$vetAppointments = $vetAppointments->orderBy(request('sortField', 'created_at'), request('sortDirection', 'desc'))->paginate(request('perPage', 5), "*", null, request('page', 1));

		$route = request('status') ? 'admin/VetAppointmentHistories' : 'admin/VetAppointments';

		return Inertia::render($route, [
			'pagination' => Inertia::always(Inertia::merge($vetAppointments)),
		]);
	}

	public function update(UpdateVetAppointmentRequest $request, string $id)
	{
		Gate::authorize('update', VetAppointment::class);
		$data = VetAppointment::where('id', $id)->firstOrFail();
		$data->update($request->all());

		return redirect('/admin/vet-appointments');
	}
}
