<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class DatabaseTestCase extends TestCase
{
	use RefreshDatabase;
	protected array $connectionsToTransact = ['mysql'];

	protected function createUser()
	{
		return User::factory()->create(['email' => 'test@gmail.com', 'password' => 'password']);
	}
}
