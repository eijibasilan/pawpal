<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreVetAppointmentRequest;
use App\Models\Admin;
use App\Models\VetAppointment;
use App\Notifications\BookedVetAppointment;
use Illuminate\Support\Facades\DB;

class VetAppointmentController extends Controller
{
	public function index()
	{
		return Inertia::render('user/VetAppointments', [
			'pagination' => Inertia::always(Inertia::merge(VetAppointment::with(['schedule.doctor', 'schedule.service', 'upload'])->where('user_id', auth('user')->user()->id)->orderBy(request('sortField', 'created_at'), request('sortDirection', 'desc'))->paginate(request('perPage', 5), "*", null, request('page', 1)))),
		]);
	}
	public function store(StoreVetAppointmentRequest $request)
	{
		DB::transaction(function () use ($request) {
			$vetAppointment = VetAppointment::create($request->all());
			$vetAppointment->load(['schedule.service', 'user']);

			$fileDirectory = "storage/user/transactions/";
			$fileName = now()->format('M-d-Y_H-i-s') . '.' . $request->image->extension();
			$request->image->storeAs("user/transactions/", $fileName, 'public');

			$vetAppointment->upload()->create([
				'file_name' => $fileName,
				'file_extension' => $request->image->getMimeType(),
				'url' => $fileDirectory . $fileName
			]);


			$doctor = Admin::where('id', $vetAppointment->schedule->doctor_id)->first();
			$doctor->notify(new BookedVetAppointment([
				'message' => 'A user has booked appointment',
				'data' => $vetAppointment
			]));

		});
		return redirect('/user/vet-services');

	}
}
