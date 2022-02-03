<?php

namespace App\Services\Departments;

use Spatie\DataTransferObject\DataTransferObject;

class DepartmentDto extends DataTransferObject
{
	public string $name;

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
			]
		);
	}
}
