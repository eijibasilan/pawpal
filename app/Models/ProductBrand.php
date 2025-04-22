<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class ProductBrand extends Model
{
	protected $fillable = [
		'name',
		'description',
	];

	public function products(): HasMany
	{
		return $this->hasMany(Product::class);
	}

	public function upload(): MorphOne
	{
		return $this->morphOne(Upload::class, 'uploadable');
	}
}
