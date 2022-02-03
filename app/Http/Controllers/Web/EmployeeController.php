<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\CreateRequest;
use App\Http\Requests\Employees\UpdateRequest;
use App\Models\Employee;
use App\Models\Gender;
use App\Services\Departments\DepartmentService;
use App\Services\Employees\EmployeeDto;
use App\Services\Employees\EmployeeService;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class EmployeeController extends Controller
{
	public function __construct(private EmployeeService $employeeService, private DepartmentService $departmentService)
	{
	}

	public function index()
	{
		$employees = $this->employeeService->paginate();

		return view('employees.index', compact('employees'));
	}

	public function create(): View
	{
		$departments = $this->departmentService->all();
        $genders = Gender::all();

		return view('employees.create', compact('departments','genders'));
	}

	public function store(CreateRequest $request): RedirectResponse
	{
		$employee = $this->employeeService->create(EmployeeDto::fromRequest($request->validated()));
		$this->flashStatus('Employee', $employee->full_name);

		return redirect()->route('employees.index');
	}

	public function edit(Employee $employee)
	{
        $genders = Gender::all();
        $departments = $this->departmentService->all();
		return view('employees.edit', compact('employee','genders','departments'));
	}

	public function update(UpdateRequest $request, Employee $employee)
	{
		$this->employeeService->update($employee, $request->validated());
		$this->flashStatus('Employee', $employee->name, 'updated');

		return redirect()->route('employees.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Employee $employee): RedirectResponse
	{
		$this->employeeService->destroy($employee);

		return redirect()->route('employees.index');
	}
}
