<?php

namespace Tests\Feature\Http;

use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\DatabaseTestCase;

class DashboardControllerTest extends DatabaseTestCase
{
	use WithFaker;

	/** @test */
	public function it_requires_an_authenticated_user(): void
	{
		$response = $this->get(route('dashboard'));

		$response->assertStatus(Response::HTTP_FOUND);
		$response->assertLocation(route('login'));
	}

	/** @test */
	public function index_displays_view(): void
	{
		$user = $this->createUser();
		$response = $this->actingAs($user)->get(route('dashboard'));

		$response->assertOk();
		$response->assertViewIs('dashboard');
		$response->assertViewHas('employees');
		$response->assertViewHas('departments');
	}
}
