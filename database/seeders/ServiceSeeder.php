<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$data = [
			[
				'name' => 'Vaccination',
			],
			[
				'name' => 'Medication',
			],
			[
				'name' => 'Deworming',
			],
			[
				'name' => 'Spray & Neuter',
			],
		];

		Service::insert($data);
	}
}
