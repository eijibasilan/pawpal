<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{

	protected $fillable = [
		'file_name',
		'file_extension',
		'file_type',
		'url',
	];

	protected $hidden = [
		'uploadable_type',
		'uploadable_id',
	];

	public function uploadable(): MorphTo
	{
		return $this->morphTo();
	}
}
