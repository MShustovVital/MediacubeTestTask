<?php

namespace Tests\Feature\Http;

use App\Models\Department;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\DatabaseTestCase;

class DepartmentControllerTest extends DatabaseTestCase
{
	use WithFaker;

	/** @test */
	public function it_requires_an_authenticated_user(): void
	{
		$response = $this->get(route('departments.index'));

		$response->assertStatus(Response::HTTP_FOUND);
		$response->assertLocation(route('login'));
	}

	/** @test */
	public function index_displays_view(): void
	{
		Department::factory()->count(5)->create();

		$user = $this->createUser();
		$response = $this->actingAs($user)->get(route('departments.index'));

		$response->assertOk();
		$response->assertViewIs('departments.index');
		$response->assertViewHas('departments');
	}

	/** @test */
	public function create_displays_view(): void
	{
		$user = $this->createUser();
		$response = $this->actingAs($user)->get(route('departments.create'));

		$response->assertOk();
		$response->assertViewIs('departments.create');
	}

	/** @test */
	public function store_saves_and_redirects(): void
	{
		$data = [
			'name' => $this->faker->word,
		];

		$user = $this->createUser();
		$response = $this->actingAs($user)->post(
			route('departments.store'),
			$data
		);

		$department = Department::query()
			->where('name', $data['name'])
			->get();
		$this->assertCount(1, $department);
		$department = $department->first();

		$response->assertRedirect(route('departments.index'));
		$response->assertSessionHas('status', "Department $department->name created successfully");
	}

	/** @test */
	public function edit_displays_view(): void
	{
		$department = Department::factory()->create();

		$user = $this->createUser();
		$response = $this->actingAs($user)->get(route('departments.edit', $department));

		$response->assertOk();
		$response->assertViewIs('departments.edit');
		$response->assertViewHas('department');
	}

	/** @test */
	public function update_redirects(): void
	{
		$department = Department::factory()->create();
		$name = $this->faker->name;

		$user = $this->createUser();
		$response = $this->actingAs($user)->put(route('departments.update', $department), [
			'name' => $name,
		]);

		$department->refresh();

		$response->assertRedirect(route('departments.index'));

		$response->assertSessionHas('status', "Department $department->name updated successfully");

		$this->assertEquals($name, $department->name);
	}

	/** @test */
	public function destroy_deletes_and_redirects(): void
	{
		$department = Department::factory()->create();

		$user = $this->createUser();
		$response = $this->actingAs($user)->delete(route('departments.destroy', $department));

		$response->assertRedirect(route('departments.index'));

		$this->assertDeleted($department);
	}
}
