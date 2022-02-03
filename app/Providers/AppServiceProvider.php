<?php

namespace App\Providers;

use App\Models\Department;
use App\Models\Employee;
use App\Services\Departments\DepartmentService;
use App\Services\Employees\EmployeeService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerServices();
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
	}

	private function registerServices(): void
	{
		$this->app->when(DepartmentService::class)
			->needs(Model::class)
			->give(Department::class);

		$this->app->when(EmployeeService::class)
			->needs(Model::class)
			->give(Employee::class);
	}
}
