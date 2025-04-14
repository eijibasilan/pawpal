<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VetServiceType extends Model
{
	protected $fillable = [
		'name',
		'description',
		'vet_service_id',
	];

	public function service(): BelongsTo
	{
		return $this->belongsTo(VetService::class, 'vet_service_id');
	}

}
