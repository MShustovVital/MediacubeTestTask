<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
	protected $model = Employee::class;

	public function definition()
	{
		return [
			'name' => $this->faker->word,
			'surname' => $this->faker->word,
			'patronymic' => $this->faker->word,
			'salary' => rand(1, 100),
		];
	}
}
