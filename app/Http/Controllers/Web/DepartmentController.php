<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Departments\CreateRequest;
use App\Http\Requests\Departments\UpdateRequest;
use App\Models\Department;
use App\Services\Departments\DepartmentDto;
use App\Services\Departments\DepartmentService;
use App\Services\Exceptions\InvalidArgumentException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DepartmentController extends Controller
{
	public function __construct(private DepartmentService $departmentService)
	{
	}

	public function index()
	{
		$departments = $this->departmentService->paginate();

		return view('departments.index', compact('departments'));
	}

	public function create(): View
	{
		return view('departments.create');
	}

	public function store(CreateRequest $createRequest): RedirectResponse
	{
		$department = $this->departmentService->create(DepartmentDto::fromRequest($createRequest->validated()));
		$this->flashStatus('Department', $department->name);

		return redirect()->route('departments.index');
	}

	public function show(Department $department)
	{
		return view('mapping.attributes.show', compact('department'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Department $department)
	{
		return view('departments.edit', compact('department'));
	}

	public function update(UpdateRequest $request, Department $department)
	{
		$department = $this->departmentService->update($department, $request->validated());
		$this->flashStatus('Department', $department->name, 'updated');

		return redirect()->route('departments.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Department $department): RedirectResponse
	{
		try {
			$this->departmentService->destroy($department);
		} catch (InvalidArgumentException $e) {
			session()->flash('status', $e->getMessage());
		} finally {
			return redirect()->route('departments.index');
		}
	}
}
