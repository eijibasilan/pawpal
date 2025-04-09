<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$rows = [
			['name' => 'Pet Food'],
			['name' => 'Medicine'],
		];

		foreach ($rows as $row)
			ProductCategory::create($row);
	}
}
