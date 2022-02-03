<?php

namespace App\Services\Employees;

use Spatie\DataTransferObject\DataTransferObject;

class EmployeeDto extends DataTransferObject
{
	public string $name;
	public string $surname;
	public ?string $patronymic;
	public float $salary;
	public array $departments;
	public int $gender_id;

	/**
	 * @param array<mixed> $request
	 *
	 * @return static
	 */
	public static function fromRequest(array $request): self
	{
		return new self(
			[
				'name' => $request['name'],
				'surname' => $request['surname'],
				'patronymic' => $request['patronymic'] ?? '',
				'salary' => $request['salary'],
				'departments' => $request['departments'],
				'gender_id' => $request['gender_id'],
			]
		);
	}
}
