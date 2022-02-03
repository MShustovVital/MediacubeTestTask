<?php

namespace Tests\Unit;

use App\Models\Department;
use App\Services\Departments\DepartmentDto;
use App\Services\Departments\DepartmentService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\DatabaseTestCase;

class DepartmentServiceTest extends DatabaseTestCase
{
	use WithFaker;

	private DepartmentService $departmentService;

	public function setUp(): void
	{
		parent::setUp();
		$this->departmentService = app()->make(DepartmentService::class);
	}

	/** @test */
	public function it_creates_a_department_with_valid_data()
	{
		$input = [
			'name' => $this->faker->name(),
		];

		$this->departmentService->create(DepartmentDto::fromRequest($input));

		$departments = Department::query()
			->where('name', $input['name'])
			->get();
		$this->assertCount(1, $departments);
	}

	/** @test */
	public function it_returns_a_department_by_id()
	{
		$department = Department::factory()->create();
		$searchedDepartment = $this->departmentService->getById($department->id);
		self::assertInstanceOf(Department::class, $searchedDepartment);
		self::assertTrue($department->is($searchedDepartment));
	}

	/** @test */
	public function it_returns_all_departments()
	{
		Department::factory()->count(2)->create();
		$departments = $this->departmentService->all();
		self::assertInstanceOf(Collection::class, $departments);
		self::assertCount(2, $departments);
	}

	/** @test */
	public function it_returns_paginated_departments()
	{
		Department::factory()->count(5)->create();
		$departments = $this->departmentService->paginate();
		self::assertInstanceOf(LengthAwarePaginator::class, $departments);
		self::assertCount(5, $departments);
	}

	/** @test */
	public function it_updates_a_department()
	{
		$department = Department::factory()->create([
			'name' => 'original name',
		]);
		$new_name = 'new name';

		$department = $this->departmentService->update($department, ['name' => $new_name]);

		$this->assertDatabaseHas('departments', [
			'id' => $department->id,
			'name' => 'new name',
		]);
	}

	/** @test */
	public function it_destroys_a_department()
	{
		$department = Department::factory()->create();

		$this->assertDatabaseHas('departments', ['id' => $department->id]);

		$this->departmentService->destroy($department);

		$this->assertDatabaseMissing('departments', ['id' => $department->id]);
	}
}
