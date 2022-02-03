<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\DepartmentController;
use App\Http\Controllers\Web\EmployeeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return redirect()->route('login');
});

Route::group(['middleware' => ['auth']], function () {
	Route::get('/dashboard', DashboardController::class)->name('dashboard');
	Route::resource('/departments', DepartmentController::class)->except('show');
    Route::resource('/employees', EmployeeController::class)->except('show');
});
