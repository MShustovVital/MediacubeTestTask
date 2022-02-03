<?php

namespace Tests\Feature\Http;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Gender;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\DatabaseTestCase;

class EmployeeControllerTest extends DatabaseTestCase
{
	use WithFaker;

	/** @test */
	public function it_requires_an_authenticated_user(): void
	{
		$response = $this->get(route('employees.index'));

		$response->assertStatus(Response::HTTP_FOUND);
		$response->assertLocation(route('login'));
	}

	/** @test */
	public function index_displays_view(): void
	{
		$employee = $this->createEmployee();

		$user = $this->createUser();
		$response = $this->actingAs($user)->get(route('employees.index'));

		$response->assertOk();
		$response->assertViewIs('employees.index');
		$response->assertViewHas('employees');
	}

	/** @test */
	public function create_displays_view(): void
	{
		$user = $this->createUser();
		$response = $this->actingAs($user)->get(route('employees.create'));

		$response->assertOk();
		$response->assertViewIs('employees.create');
		$response->assertViewHas('genders');
		$response->assertViewHas('departments');
	}

	/** @test */
	public function store_saves_and_redirects(): void
	{
		$gender = Gender::factory()->create();
		$departments = Department::factory()->create();

        $data = [
            'name' => $this->faker->word,
            'surname' => $this->faker->word,
            'patronymic' => $this->faker->word,
            'salary' => rand(1, 100),
            'gender_id' => $gender->id,
            'departments' => $departments->pluck('id')->toArray(),
        ];

		$user = $this->createUser();
		$response = $this->actingAs($user)->post(
			route('employees.store'),
			$data
		);

		$employees = Employee::query()
			->get();
		$this->assertCount(1, $employees);
		$employee = $employees->first();

		$response->assertRedirect(route('employees.index'));
		$response->assertSessionHas('status', "Employee $employee->full_name created successfully");
	}

	/** @test */
	public function edit_displays_view(): void
	{
		$employee = $this->createEmployee();

		$user = $this->createUser();
		$response = $this->actingAs($user)->get(route('employees.edit', $employee));

		$response->assertOk();
		$response->assertViewIs('employees.edit');
		$response->assertViewHas('employee');
	}

	/** @test */
	public function update_redirects(): void
	{
		$employee = $this->createEmployee();
		$name = $this->faker->name;

		$user = $this->createUser();
		$response = $this->actingAs($user)->put(route('employees.update', $employee), [
			'name' => $name,
		]);

		$employee->refresh();

		$response->assertRedirect(route('employees.index'));

		$response->assertSessionHas('status', "Employee $employee->name updated successfully");

		$this->assertEquals($name, $employee->name);
	}

	/** @test */
	public function destroy_deletes_and_redirects(): void
	{
		$employee = $this->createEmployee();

		$user = $this->createUser();
		$response = $this->actingAs($user)->delete(route('employees.destroy', $employee));

		$response->assertRedirect(route('employees.index'));

		$this->assertDeleted($employee);
	}

	private function createEmployee()
	{
		$gender = Gender::factory()->create(['name' => 'm']);

		return Employee::factory()->create(['gender_id' => $gender->id]);
	}
}
