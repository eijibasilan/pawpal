<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreVetAppointmentRequest;
use App\Models\VetAppointment;

class VetAppointmentController extends Controller
{
	public function store(StoreVetAppointmentRequest $request)
	{
		VetAppointment::create($request->all());
		return redirect('/user/vet-services');
	}
}
