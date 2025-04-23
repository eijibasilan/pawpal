<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\VetAppointment;

class VetAppointmentController extends Controller
{
	public function index()
	{
		$vetAppointments = VetAppointment::with(['schedule.doctor', 'schedule.service', 'user'])->whereHas('schedule', function ($query) {
			$query->where('doctor_id', auth('admin')->user()->id);
		})->orderBy(request('sortField', ''), request('sortDirection', 'desc'))->paginate(request('perPage', 5), "*", null, request('page', 1));

		return Inertia::render('admin/VetAppointments', [
			'pagination' => Inertia::always(Inertia::merge($vetAppointments)),
		]);
	}
}
