<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Departments\DepartmentService;
use App\Services\Employees\EmployeeService;
use Illuminate\View\View;

class DashboardController extends Controller
{
	public function __construct(private EmployeeService $employeeService, private DepartmentService $departmentService)
	{
	}

	public function __invoke(): View
	{
		$employees = $this->employeeService->paginate();
		$departments = $this->departmentService->all();

		return view('dashboard', compact('employees', 'departments'));
	}
}
