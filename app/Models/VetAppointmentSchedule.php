<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VetAppointmentSchedule extends Model
{
	protected $fillable = [
		'scheduled_date',
		'start_time',
		'end_time',
		'vet_service_id',
		'doctor_id',
	];

	public function doctor(): BelongsTo
	{
		return $this->belongsTo(Admin::class, 'doctor_id');
	}

	public function service(): BelongsTo
	{
		return $this->belongsTo(VetService::class, 'vet_service_id');
	}
}
