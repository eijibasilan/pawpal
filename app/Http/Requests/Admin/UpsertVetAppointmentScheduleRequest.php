<?php

namespace App\Http\Requests\Admin;

use App\Rules\HasAdminRoles;
use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class UpsertVetAppointmentScheduleRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		$now = Carbon::now()->timezone('Asia/Manila');

		return [
			"scheduled_date" => "required|date|after:$now",
			"start_time" => "required|date_format:H:i",
			"end_time" => "required|date_format:H:i|after:start_time",
			"vet_service_id" => "required|exists:vet_services,id",
			"doctor_id" => ["required", "exists:admins,id", new HasAdminRoles(['Doctor'])],
		];
	}
}
