<?php

namespace Database\Seeders;

use App\Models\VetService;
use Illuminate\Database\Seeder;

class VetServiceSeeder extends Seeder
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
			VetService::create($row);
	}
}
