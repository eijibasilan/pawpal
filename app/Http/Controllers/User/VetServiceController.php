<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\VetAppointmentSchedule;
use App\Models\VetService;
use Inertia\Inertia;

class VetServiceController extends Controller
{
	public function index()
	{
		$now = now();
		$oneMonthLater = now()->addMonth();

		$vetServices = VetService::with('uploads', 'types')->get();
		$vetAppointmentSchedules = VetAppointmentSchedule::with('doctor', 'service')->where('scheduled_date', '>=', $now)
			->where('scheduled_date', '<', $oneMonthLater)
			->get();

		return Inertia::render('user/VetServices', [
			'vetServices' => $vetServices,
			'vetAppointmentSchedules' => Inertia::lazy(fn() => $vetAppointmentSchedules)

		]);
	}
}
