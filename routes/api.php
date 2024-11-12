<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('employees', [EmployeeController::class, 'getEmployees'])->name('employees');
Route::get('employeesNamePin', [EmployeeController::class, 'getEmployeeNamePin'])->name('employeesNamePin');
Route::get('employees-for-workshop', [EmployeeController::class, 'getEmployeesForWorkshop'])->name('employees-workshop');
Route::get('employee-with-OldPin-safer', [EmployeeController::class, 'getEmployeeWithOldPinForSafer'])->name('employee-with-OldPin-safer');
Route::get('employee-with-NewPin-safer', [EmployeeController::class, 'getEmployeeWithNewPinForSafer'])->name('employee-with-NewPin-safer');
Route::get('employee-image-workshop', [EmployeeController::class, 'getEmployeeImageForWorkshop'])->name('employee-image-workshop');
Route::get('employee-signature-workshop', [EmployeeController::class, 'getEmployeeSignatureForWorkshop'])->name('employee-signature-workshop');
Route::get('employees-for-one-stop', [EmployeeController::class, 'getEmployeesForOneStop'])->name('employees-one-stop');
Route::get('employee-image-one-stop', [EmployeeController::class, 'getEmployeeImageForOneStop'])->name('employee-image-one-stop');
Route::get('employee-signature-one-stop', [EmployeeController::class, 'getEmployeeSignatureForOneStop'])->name('employee-signature-one-stop');
