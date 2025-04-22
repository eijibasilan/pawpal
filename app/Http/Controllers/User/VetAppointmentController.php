<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreVetAppointmentRequest;
use App\Models\VetAppointment;

class VetAppointmentController extends Controller
{
	public function index()
	{
		return Inertia::render('user/VetAppointments', [
			'pagination' => Inertia::always(Inertia::merge(VetAppointment::with(['schedule.doctor', 'schedule.service'])->where('user_id', auth('user')->user()->id)->paginate(request('perPage', 5), "*", null, request('page', 1)))),
		]);
	}
	public function store(StoreVetAppointmentRequest $request)
	{
		VetAppointment::create($request->all());
		return redirect('/user/vet-services');
	}
}
