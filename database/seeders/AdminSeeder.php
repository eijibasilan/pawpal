<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		Admin::factory(1)
			->create()
			->each(function ($admin) {
				$admin->assignRole('Business Admin');
			});

		Admin::factory(3)
			->create()
			->each(function ($admin) {
				$admin->assignRole('Admin');
			});

		Admin::factory(3)
			->create()
			->each(function ($admin) {
				$admin->assignRole('Doctor');
			});

	}
}
