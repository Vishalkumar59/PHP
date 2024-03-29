<?php

use Illuminate\Support\Facades\Route;
use Modules\UserManage\Http\Controllers\UserController;
use Modules\UserManage\Http\Controllers\RoleController;
use Modules\UserManage\Http\Controllers\StaffController;
use Modules\UserManage\Http\Controllers\DepartmentController;
use Modules\UserManage\Http\Controllers\DesignationController;

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




// Route::get('/', function () {
//     return view('auth/login');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


Route::group(['middleware' => 'auth'], function () {


   Route::resource('role', RoleController::class);

   Route::post('role/updatestatus', [RoleController::class,'sortorder'])->name('updatestatus');

   Route::resource('user', UserController::class);
   Route::post('user-status-chenge',[UserController::class, 'ChangeUserStatus'])->name('user-status-chenge');
   Route::post('change-password', [UserController::class, 'UpdatePassword'])->name('change-password');
   Route::get('data/delete/{id}', [UserController::class, 'delete'])->name('delete');
   
   // staff route
   Route::resource('employee', StaffController::class);
   Route::post('employee-status-change', [StaffController::class,'changeEmployeeStatus'])->name('employee-status-change');

   // department
   Route::resource('department', DepartmentController::class);
    Route::post('department/updateData', [DepartmentController::class,'departmentUpdate'])->name('department-updatedata');
    Route::post('department/changeStatus', [DepartmentController::class,'changedepartmentStatus'])->name('changeStatus');
    Route::post('departmentDestroy/{id}', [DepartmentController::class,'departmentDestroy'])->name('departmentDestroy');


   //DESIGNATION ROUTES
   Route::resource('designation', DesignationController::class);
   Route::post('designation/Update', [DesignationController::class,'designationtUpdate'])->name('designation-updatedata');
   Route::post('designationDestroy/{id}', [DesignationController::class,'designationDestroy'])->name('designationDestroy');
   Route::post('designation/changedesignationStatus', [DesignationController::class,'changedesignationStatus'])->name('changedesignationStatus');
});

