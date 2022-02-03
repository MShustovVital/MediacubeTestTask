<?php

namespace App\Services\Employees;

use App\Services\Contracts\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\DataTransferObject\DataTransferObject;

class EmployeeService extends Service
{
	public function create(DataTransferObject $data): Model
	{
		DB::beginTransaction();
		$model = parent::create($data);
		$model->departments()->attach($data->toArray()['departments']);
		DB::commit();

		return $model;
	}

	public function update(Model $model, array $data): Model
	{
		$model->departments()->sync($data['departments'] ?? []);

		return parent::update($model, $data);
	}
}
