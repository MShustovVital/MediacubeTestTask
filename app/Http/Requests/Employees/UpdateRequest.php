<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
			'name' => 'string|max:100',
			'surname' => 'string|max:100',
			'patronymic' => 'string|max:100',
			'salary' => 'numeric|min:0',
			'gender_id' => 'numeric|exists:genders,id',
			'departments' => 'array|exists:departments,id',
		];
	}
}
