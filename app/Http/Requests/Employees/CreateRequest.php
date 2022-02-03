<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => 'required|string|max:100',
			'surname' => 'required|string|max:100',
			'patronymic' => 'string|max:100',
			'salary' => 'required|numeric|min:0',
			'gender_id' => 'required|numeric|exists:genders,id',
			'departments' => 'required|array|exists:departments,id',
		];
	}
}
