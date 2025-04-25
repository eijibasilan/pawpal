<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\UpdateVetAppointmentRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\VetAppointment;
use App\Models\VetServiceType;
use App\Notifications\ApprovedVetAppointment;
use Illuminate\Http\Request;

class VetAppointmentController extends Controller
{
	public function index()
	{
		Gate::authorize('viewAny', VetAppointment::class);
		$vetAppointments = VetAppointment::with(['schedule.doctor', 'schedule.service', 'user', 'upload']);

		if (!auth('admin')->user()->hasAnyRole('Business Admin', 'Admin')) {
			$vetAppointments = $vetAppointments->whereHas('schedule', function ($query) {
				$query->where('doctor_id', auth('admin')->user()->id);
			})->where('status', 'For Approval');
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
		DB::transaction(function () use ($id, $request) {
			Gate::authorize('update', VetAppointment::class);
			$data = VetAppointment::with('schedule')->where('id', $id)->firstOrFail();
			$data->update($request->all());

			//$doctor = 
		});

		return redirect('/admin/vet-appointments');
	}

	public function approveVetAppointment(Request $request, string $id)
	{
		//Gate::authorize('update', VetAppointment::class);
		DB::transaction(function () use ($id, $request) {
			$data = VetAppointment::with('schedule.service')->where('id', $id)->firstOrFail();
			$data->update(['status' => 'Approved']);

			$details = json_decode($data->details);

			$vetServiceType = VetServiceType::where('name', $details->type)->first();

			$vetServiceType->quantity -= $details->quantity;
			$vetServiceType->save();

			$user = User::where('id', $data->user_id)->first();

			$user->notify(new ApprovedVetAppointment([
				'message' => 'Your appointment has been approved on ' . $data->schedule->scheduled_date,
				'data' => $data,
			]));
		});

		return redirect('/admin/vet-appointments');
	}
}
