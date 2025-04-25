<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class VetAppointment extends Model
{
	protected $fillable = [
		'user_id',
		'vet_appointment_schedule_id',
		'details',
		'status'
	];
	protected function casts(): array
	{
		return [
			'details' => 'json',
		];
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function schedule(): BelongsTo
	{
		return $this->belongsTo(VetAppointmentSchedule::class, 'vet_appointment_schedule_id');
	}

	public function upload(): MorphOne
	{
		return $this->morphOne(Upload::class, 'uploadable');
	}
}
