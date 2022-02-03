<?php

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentEmployeeTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('department_employee', function (Blueprint $table) {
			$table->foreignIdFor(Employee::class)
				->constrained()
				->cascadeOnDelete()
				->cascadeOnUpdate();
			$table->foreignIdFor(Department::class)
				->constrained()
				->cascadeOnDelete()
				->cascadeOnUpdate();
			$table->primary(['employee_id', 'department_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('department_employee');
	}
}
