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
		$rows = [
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

		foreach ($rows as $row)
			Service::create($row);
	}
}
