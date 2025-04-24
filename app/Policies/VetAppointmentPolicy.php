<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\VetAppointment;
use Illuminate\Auth\Access\Response;

class VetAppointmentPolicy
{

	public function viewAny(Admin $admin): bool
	{
		return $admin->hasRole(['Admin', 'Doctor']);
	}


	public function viewOnlyOwn(Admin $admin): bool
	{
		return $admin->hasRole(['Admin', 'Doctor']);
	}

	public function update(Admin $admin): bool
	{
		return $admin->hasRole(['Admin']);
	}
}
