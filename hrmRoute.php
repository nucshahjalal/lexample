<?php

use App\Http\Controllers\Hrm\EmpDepartmentController;
use App\Http\Controllers\Hrm\EmpDesignationController;
use App\Http\Controllers\Hrm\EmployeeController;

Route::group(['middleware' => 'auth', 'prefix' => 'hrm'], function() {
    
    Route::any('department', [EmpDepartmentController::class, 'index'])->name('department.list');
    Route::get('department/add', [EmpDepartmentController::class, 'add'])->name('department.add');
    Route::post('department/save', [EmpDepartmentController::class, 'save'])->name('department.save');
    Route::get('department/edit/{id}', [EmpDepartmentController::class, 'edit'])->name('department.edit');
    Route::post('department/update', [EmpDepartmentController::class, 'update'])->name('department.update');
    Route::delete('department/delete/{id}', [EmpDepartmentController::class, 'delete'])->name('department.delete');
    
    Route::any('designation', [EmpDesignationController::class, 'index'])->name('designation.list');
    Route::get('designation/add', [EmpDesignationController::class, 'add'])->name('designation.add');
    Route::post('designation/save', [EmpDesignationController::class, 'save'])->name('designation.save');
    Route::get('designation/edit/{id}', [EmpDesignationController::class, 'edit'])->name('designation.edit');
    Route::post('designation/update', [EmpDesignationController::class, 'update'])->name('designation.update');
    Route::delete('designation/delete/{id}', [EmpDesignationController::class, 'delete'])->name('designation.delete');

    Route::get('employee', [EmployeeController::class, 'index'])->name('employee.list');
    Route::get('employee/add', [EmployeeController::class, 'add'])->name('employee.add');
    Route::post('employee/save', [EmployeeController::class, 'save'])->name('employee.save');
    Route::get('employee/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::post('employee/update', [EmployeeController::class, 'update'])->name('employee.update');
    Route::any('employee/view/{id}', [EmployeeController::class, 'view'])->name('employee.view');
    Route::delete('employee/delete/{id}', [EmployeeController::class, 'delete'])->name('employee.delete');
    Route::post('employee/update-order', [EmployeeController::class, 'updateOrder'])->name('employee.update-order');

});


use App\Http\Controllers\Teacher\TeacherDepartmentController;
use App\Http\Controllers\Teacher\TeacherController;

Route::prefix('teacher')->group(function () {
    
    Route::get('manage-department', [TeacherDepartmentController::class, 'index'])->name('manage-department.list');
    Route::get('manage-department/add', [TeacherDepartmentController::class, 'add'])->name('manage-department.add');
    Route::post('manage-department/save', [TeacherDepartmentController::class, 'save'])->name('manage-department.save');
    Route::get('manage-department/edit/{id}', [TeacherDepartmentController::class, 'edit'])->name('manage-department.edit');
    Route::post('manage-department/update', [TeacherDepartmentController::class, 'update'])->name('manage-department.update');
    Route::delete('manage-department/delete/{id}', [TeacherDepartmentController::class, 'delete'])->name('manage-department.delete');
    
    Route::get('manage-teacher', [TeacherController::class, 'index'])->name('manage-teacher.list');
    Route::get('manage-teacher/add', [TeacherController::class, 'add'])->name('manage-teacher.add');
    Route::post('manage-teacher/save', [TeacherController::class, 'save'])->name('manage-teacher.save');
    Route::get('manage-teacher/edit/{id}', [TeacherController::class, 'edit'])->name('manage-teacher.edit');
    Route::post('manage-teacher/update', [TeacherController::class, 'update'])->name('manage-teacher.update');
    Route::get('manage-teacher/view/{id}', [TeacherController::class, 'view'])->name('manage-teacher.view');
    Route::delete('manage-teacher/delete/{id}', [TeacherController::class, 'delete'])->name('manage-teacher.delete');
    
})->middleware('auth');

