<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UpsertAdminRequest extends FormRequest
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
		$rules = [
			'name' => 'required|string|max:255',
			'email' => 'required|string|lowercase|email|max:255|unique:admins,email,',
			'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
			"roles" => "nullable|array",
			"roles.*" => "exists:roles,id",
		];

		if ($this->method() === 'PUT' || $this->method() === 'PATCH') {
			$explodedPaths = explode('/', $this->path());
			$routeParam = $explodedPaths[count($explodedPaths) - 1];

			$rules['email'] .= $routeParam;
		}

		return $rules;
	}

	protected function passedValidation(): void
	{
		$validated = $this->validated();
		$validated['password'] = Hash::make($this->password);

		$this->replace($validated);
	}

}
