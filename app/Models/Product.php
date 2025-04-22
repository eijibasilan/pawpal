<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
	protected $fillable = [
		'name',
		'product_category_id',
		'product_brand_id',
		'quantity',
		'unit',
	];

	public function category(): BelongsTo
	{
		return $this->belongsTo(ProductCategory::class, 'product_category_id');
	}

	public function brand(): BelongsTo
	{
		return $this->belongsTo(ProductBrand::class, 'product_brand_id');
	}

	public function uploads(): MorphMany
	{
		return $this->morphMany(Upload::class, 'uploadable');
	}
}
