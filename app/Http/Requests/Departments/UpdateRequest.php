<?php

namespace App\Http\Requests\Departments;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		$department = $this->route('department');

		return [
			'name' => ['required', 'string', 'max:255', Rule::unique('departments')->ignore($department)],
		];
	}
}
