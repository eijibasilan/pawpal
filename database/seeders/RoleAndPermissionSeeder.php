<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		// Reset cached roles and permissions
		app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


		//$permissions = [
		//	'view admin',
		//	'store admin',
		//	'update admin',
		//	'delete admin',
		//	'view appointment'
		//];

		//foreach ($permissions as $permission)
		//	Permission::create([
		//		'name' => $permission,
		//		'guard_name' => 'admin'
		//	]);


		// update cache to know about the newly created permissions (required if using WithoutModelEvents in seeders)
		//app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

		$roles = [
			"Business Admin",
			"Admin",
			"Doctor",
		];

		foreach ($roles as $role)
			Role::create(['name' => $role, 'guard_name' => 'admin']);

	}
}
