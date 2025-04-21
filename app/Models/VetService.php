<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class VetService extends Model
{
	protected $fillable = [
		'name',
		'description',
	];

	public function types(): HasMany
	{
		return $this->hasMany(VetServiceType::class, 'vet_service_id');
	}

	public function appointment_schedules(): HasMany
	{
		return $this->hasMany(VetAppointmentSchedule::class, );
	}

	public function uploads(): MorphMany
	{
		return $this->morphMany(Upload::class, 'uploadable');
	}
}
