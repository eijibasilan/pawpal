<?php

namespace App\Policies;

use App\Models\Admin;

class RolePolicy
{
	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAny(Admin $admin): bool
	{
		return $admin->hasRole(['Admin']);
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function store(Admin $admin): bool
	{

		return $admin->hasRole(['Admin']);
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(Admin $admin): bool
	{

		return $admin->hasRole(['Admin']);
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(Admin $admin): bool
	{
		return $admin->hasRole(['Admin']);
	}
}
