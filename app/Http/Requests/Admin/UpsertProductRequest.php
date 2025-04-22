<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpsertProductRequest extends FormRequest
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
			"name" => "required|min:3|unique:products,name,",
			"product_category_id" => "required|exists:product_categories,id",
			"product_brand_id" => "required|exists:product_brands,id",
			"quantity" => "required|numeric",
			"unit" => "nullable|string",
			'images' => 'nullable|array',
			'images.*' => 'image|mimes:jpeg,png,jpg,jfif,gif|max:2048'
		];

		if ($this->method() === 'PUT' || $this->method() === 'PATCH') {
			$explodedPaths = explode('/', $this->path());
			$routeParam = $explodedPaths[count($explodedPaths) - 1];

			$rules['name'] .= $routeParam;
		}

		return $rules;
	}
}
