<?php

namespace Tests\Unit;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Gender;
use App\Services\Employees\EmployeeDto;
use App\Services\Employees\EmployeeService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\DatabaseTestCase;

class EmployeeServiceTest extends DatabaseTestCase
{
	use WithFaker;

	private EmployeeService $employeeService;

	public function setUp(): void
	{
		parent::setUp();
		$this->employeeService = app()->make(EmployeeService::class);
	}

	/** @test */
	public function it_creates_a_employee_with_valid_data()
	{
		$gender = Gender::factory()->create();
		$departments = Department::factory()->create();
		$input = [
			'name' => $this->faker->word,
			'surname' => $this->faker->word,
			'patronymic' => $this->faker->word,
			'salary' => rand(1, 100),
			'gender_id' => $gender->id,
			'departments' => $departments->pluck('id')->toArray(),
		];

		$this->employeeService->create(EmployeeDto::fromRequest($input));

		$employees = Employee::query()
			->where('name', $input['name'])
			->get();
		$this->assertCount(1, $employees);
	}

	/** @test */
	public function it_returns_a_employee_by_id()
	{
		$employee = $this->createEmployee();
        $searchedEmployee = $this->employeeService->getById($employee->id);
		self::assertInstanceOf(Employee::class, $searchedEmployee);
		self::assertTrue($employee->is($searchedEmployee));
	}

	/** @test */
	public function it_returns_all_employees()
	{
		$this->createEmployee();
		$employees = $this->employeeService->all();
		self::assertInstanceOf(Collection::class, $employees);
		self::assertCount(1, $employees);
	}

	/** @test */
	public function it_returns_paginated_employees()
	{
		$this->createEmployee();
		$employees = $this->employeeService->paginate();
		self::assertInstanceOf(LengthAwarePaginator::class, $employees);
		self::assertCount(1, $employees);
	}

	/** @test */
	public function it_updates_a_employee()
	{
		$employee = $this->createEmployee();
		$new_name = 'new name';

		$employee = $this->employeeService->update($employee, ['name' => $new_name]);

		$this->assertDatabaseHas('employees', [
			'id' => $employee->id,
			'name' => 'new name',
		]);
	}

	/** @test */
	public function it_destroys_a_employee()
	{
		$employee = $this->createEmployee();

		$this->assertDatabaseHas('employees', ['id' => $employee->id]);

		$this->employeeService->destroy($employee);

		$this->assertDatabaseMissing('employees', ['id' => $employee->id]);
	}

	private function createEmployee()
	{
		$gender = Gender::factory()->create(['name' => 'm']);

		return Employee::factory()->create(['gender_id' => $gender->id]);
	}
}
