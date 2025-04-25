<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAny(Admin $admin): bool
	{
		return $admin->hasRole(['Admin']);
	}
}
