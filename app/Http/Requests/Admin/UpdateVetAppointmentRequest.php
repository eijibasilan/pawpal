<?php

namespace App\Http\Requests\Admin;

use App\Models\VetAppointment;
use App\Models\VetServiceType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateVetAppointmentRequest extends FormRequest
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
		return [
			"quantity" => "required|numeric|gt:0",
		];
	}


	public function after(): array
	{
		return [
			function (Validator $validator) {
				if (!$this->hasEnoughStocks()) {
					$validator->errors()->add(
						'quantity',
						'Out of stock!'
					);
					return;
				}
			},
		];
	}


	protected function passedValidation(): void
	{
		$explodedPaths = explode('/', $this->path());
		$routeParam = $explodedPaths[count($explodedPaths) - 1];

		$vetAppointment = VetAppointment::findOrFail($routeParam);
		$validated = $this->validated();

		$details = [];

		foreach (json_decode($vetAppointment->details) as $key => $value) {
			$details[$key] = $value;
		}

		$details['quantity'] = $this->quantity;

		$validated['details'] = json_encode($details);
		$validated['status'] = 'For Approval';

		$this->replace($validated);
	}

	private function hasEnoughStocks()
	{
		$vetAppointmentType = VetServiceType::where('name', $this->getVetServiceType())->first();
		return $vetAppointmentType->quantity >= $this->quantity;
	}

	private function getVetServiceType()
	{
		$explodedPaths = explode('/', $this->path());
		$routeParam = $explodedPaths[count($explodedPaths) - 1];

		$vetAppointment = VetAppointment::findOrFail($routeParam);

		$decodedData = json_decode($vetAppointment->details);
		return $decodedData->type;
	}
}
