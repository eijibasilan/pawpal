<?php

namespace Database\Seeders;

use App\Models\ProductBrand;
use Illuminate\Database\Seeder;

class ProductBrandSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$rows = [
			['name' => 'Bearing'],
			['name' => 'Special Dog/Cat'],
			['name' => 'Pedigree'],
			['name' => 'Goodest'],
			['name' => 'Whiskas'],
			['name' => 'Royal Canin'],
			['name' => 'Monello'],
			['name' => 'Maxwell'],
			['name' => 'Snacky'],
			['name' => 'Doggo'],
		];

		foreach ($rows as $row)
			ProductBrand::create($row);
	}
}
