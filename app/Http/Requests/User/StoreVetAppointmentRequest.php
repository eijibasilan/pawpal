<?php

namespace App\Http\Requests\User;

use App\Models\VetAppointment;
use App\Models\VetAppointmentSchedule;
use App\Models\VetService;
use App\Models\VetServiceType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class StoreVetAppointmentRequest extends FormRequest
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
			"vet_service_id" => "required|exists:vet_services,id",
			"vet_service_type_id" => [
				"nullable",
				Rule::prohibitedIf(function () {
					$vetService = VetService::with('types')->find($this->vet_service_id);

					return empty($vetService->types);
				}),
				"exists:vet_service_types,id"
			],
			"scheduled_date" => [
				"required",
				"date",
				"after:$now",

			],
			"time" => "required|date_format:H:i:s",
		];
	}

	public function after(): array
	{
		return [
			function (Validator $validator) {
				if (!$this->vetAppointmentSchedule()) {
					$validator->errors()->add(
						'scheduled_date',
						'No appointment schedule found!'
					);
					return;
				}

				if ($this->existingAppointment())
					$validator->errors()->add(
						'scheduled_date',
						'This date has already been booked! Please find another date'
					);
			},
		];
	}

	protected function passedValidation(): void
	{
		$validated = $this->validated();
		$validated['user_id'] = auth('user')->user()->id;
		$validated['vet_appointment_schedule_id'] = $this->vetAppointmentSchedule()->id;

		if (isset($this->vet_service_type_id)) {
			$vetServiceType = VetServiceType::findOrFail($this->vet_service_type_id);
			$validated['details'] = json_encode(['type' => $vetServiceType->name]);
		}

		$this->replace($validated);
	}



	private function vetAppointmentSchedule()
	{
		$vetAppointmentSchedule = VetAppointmentSchedule
			::where('vet_service_id', $this->vet_service_id)
			->where('scheduled_date', $this->scheduled_date)
			->where('start_time', $this->time)
			->first();

		return $vetAppointmentSchedule;
	}

	private function existingAppointment()
	{
		return VetAppointment
			::whereHas('schedule', function ($query) {
				$query->where('vet_service_id', $this->vet_service_id)->where('scheduled_date', $this->scheduled_date)
					->where('start_time', $this->time);
			})
			->where('status', 'Pending')
			->first();
	}

}
