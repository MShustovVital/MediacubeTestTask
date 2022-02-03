<?php

namespace App\Services\Departments;

use App\Services\Contracts\Service;
use App\Services\Exceptions\InvalidArgumentException;
use Illuminate\Database\Eloquent\Model;

class DepartmentService extends Service
{
	/**
	 * @throws InvalidArgumentException
	 */
	public function destroy(Model $model): ?bool
	{
		if ($model->employees()->count() > 0) {
			$message = __('validation.custom.departments.employees');
			throw new InvalidArgumentException($message);
		}

		return parent::destroy($model);
	}
}
