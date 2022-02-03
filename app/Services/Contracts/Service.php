<?php

namespace App\Services\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\DataTransferObject\DataTransferObject;

abstract class Service
{
	protected Model $storage;

	public function __construct(Model $storage)
	{
		$this->storage = $storage;
	}

	public function create(DataTransferObject $data): Model
	{
		return $this->storage::query()->create($data->toArray());
	}

	public function update(Model $model, array $data): Model
	{
		$model->update($data);

		return $model;
	}

	public function all(): Collection
	{
		return $this->storage::query()->get();
	}

	public function destroy(Model $model): ?bool
	{
		return $model->delete();
	}

	public function paginate(): LengthAwarePaginator
	{
		return $this->storage::query()->paginate();
	}

	public function getById(int $id): Model
	{
		return $this->storage::query()->findOrFail($id);
	}
}
