<?php

use App\Http\Controllers\Student\StudentGroupController;
use App\Http\Controllers\Student\StudentTypeController;
use App\Http\Controllers\Student\StudentHouseController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\StudentAdvancedController;
use App\Http\Controllers\Student\AdmissionController;
use App\Http\Controllers\Student\ActivityController;
use App\Http\Controllers\Student\BulkController;
use App\Http\Controllers\AjaxController;

Route::group(['middleware' => 'auth', 'prefix' => 'student'],function(){
    
    // student group
    Route::get('group', [StudentGroupController::class, 'index'])->name('group.list');
    Route::get('group/add', [StudentGroupController::class, 'add'])->name('group.add');
    Route::post('group/save', [StudentGroupController::class, 'save'])->name('group.save');
    Route::get('group/edit/{id}', [StudentGroupController::class, 'edit'])->name('group.edit');
    Route::post('group/update', [StudentGroupController::class, 'update'])->name('group.update');
    Route::delete('group/delete/{id}', [StudentGroupController::class, 'delete'])->name('group.delete');
    
    //student type
    Route::get('type', [StudentTypeController::class, 'index'])->name('type.list');
    Route::get('type/add', [StudentTypeController::class, 'add'])->name('type.add');
    Route::post('type/save', [StudentTypeController::class, 'save'])->name('type.save');
    Route::get('type/edit/{id}', [StudentTypeController::class, 'edit'])->name('type.edit');
    Route::post('type/update', [StudentTypeController::class, 'update'])->name('type.update');
    Route::delete('type/delete/{id}', [StudentTypeController::class, 'delete'])->name('type.delete');
    
    //student house
    Route::get('house', [StudentHouseController::class, 'index'])->name('house.list');
    Route::get('house/add', [StudentHouseController::class, 'add'])->name('house.add');
    Route::post('house/save', [StudentHouseController::class, 'save'])->name('house.save');
    Route::get('house/edit/{id}', [StudentHouseController::class, 'edit'])->name('house.edit');
    Route::post('house/update', [StudentHouseController::class, 'update'])->name('house.update');
    Route::delete('house/delete/{id}', [StudentHouseController::class, 'delete'])->name('house.delete');
    
    //student
    Route::get('manage-student', [StudentController::class, 'index'])->name('manage-student.list');
    Route::get('manage-student/add', [StudentController::class, 'add'])->name('manage-student.add');
    Route::post('manage-student/save', [StudentController::class, 'save'])->name('manage-student.save');
    Route::get('manage-student/edit/{id}', [StudentController::class, 'edit'])->name('manage-student.edit');
    Route::post('manage-student/update', [StudentController::class, 'update'])->name('manage-student.update');
    Route::get('manage-student/class_by_section', [AjaxController::class, 'getClassBySection'])->name('manage-student.class_by_section');
    Route::get('manage-student/view/{id}', [StudentController::class, 'view'])->name('manage-student.view');
    Route::delete('manage-student/delete/{id}', [StudentController::class, 'delete'])->name('manage-student.delete');
    Route::post('manage-student/update_status_type', [StudentController::class, 'updateStatus'])->name('manage-student.update_status_type');
    Route::post('manage-student/get_guardian_by_id', [StudentController::class, 'getGuardianById'])->name('manage-student.get_guardian_by_id');
    
    Route::get('update-student', [StudentController::class, 'updateStudent'])->name('update-student.list');
    Route::post('manage-student/update_student', [StudentController::class, 'updateDisplayStudent'])->name('manage-student.update_student');

    //student admission
    Route::get('admission', [AdmissionController::class, 'index'])->name('admission.list');
    Route::get('admission/add', [AdmissionController::class, 'add'])->name('admission.add');
    Route::post('admission/save', [AdmissionController::class, 'save'])->name('admission.save');
    Route::get('admission/approve/{id}', [AdmissionController::class, 'approve'])->name('admission.approve');
    Route::post('admission/update', [AdmissionController::class, 'update'])->name('admission.update');
    Route::get('admission/view/{id}', [AdmissionController::class, 'view'])->name('admission.view');
    Route::delete('admission/delete/{id}', [AdmissionController::class, 'delete'])->name('admission.delete');
    Route::post('admission/decline_status', [AdmissionController::class, 'declineStatus'])->name('admission.decline_status');
    Route::post('admission/waiting_status', [AdmissionController::class, 'waitingStatus'])->name('admission.waiting_status');
    Route::get('admission/class_by_section', [AjaxController::class, 'getClassBySection'])->name('admission.class_by_section');
    Route::post('admission/get_guardian_by_id', [AdmissionController::class, 'getGuardianById'])->name('admission.get_guardian_by_id');
    
    //student activity
    Route::get('activity', [ActivityController::class, 'index'])->name('activity.list');
    Route::get('activity/add', [ActivityController::class, 'add'])->name('activity.add');
    Route::post('activity/save', [ActivityController::class, 'save'])->name('activity.save');
    Route::get('activity/edit/{id}', [ActivityController::class, 'edit'])->name('activity.edit');
    Route::post('activity/update', [ActivityController::class, 'update'])->name('activity.update');
    Route::get('activity/view/{id}', [ActivityController::class, 'view'])->name('activity.view');
    Route::get('activity/class_by_section', [AjaxController::class, 'getClassBySection'])->name('activity.class_by_section');
    Route::get('activity/class_section_by_student', [AjaxController::class, 'getClassSectionByStudent'])->name('activity.class_section_by_student');
    Route::delete('activity/delete/{id}', [ActivityController::class, 'delete'])->name('activity.delete');
    
    //student bulk
    Route::get('bulk', [BulkController::class, 'index'])->name('bulk.list');
    Route::get('bulk/add', [BulkController::class, 'add'])->name('bulk.add');
    Route::post('bulk/save', [BulkController::class, 'save'])->name('bulk.save');
    
    //advanced admission
    Route::get('advanced-student', [StudentAdvancedController::class, 'index'])->name('advanced-student.list');
    Route::get('advanced-student/add', [StudentAdvancedController::class, 'add'])->name('advanced-student.add');
    Route::post('advanced-student/save', [StudentAdvancedController::class, 'save'])->name('advanced-student.save');
    Route::get('advanced-student/edit/{id}', [StudentAdvancedController::class, 'edit'])->name('advanced-student.edit');
    Route::post('advanced-student/update', [StudentAdvancedController::class, 'update'])->name('advanced-student.update');
    Route::get('advanced-student/class_by_section', [AjaxController::class, 'getClassBySection'])->name('advanced-student.class_by_section');
    Route::get('advanced-student/view/{id}', [StudentAdvancedController::class, 'view'])->name('advanced-student.view');
    Route::delete('advanced-student/delete/{id}', [StudentAdvancedController::class, 'delete'])->name('advanced-student.delete');
    Route::post('advanced-student/get_guardian_by_id', [StudentAdvancedController::class, 'getGuardianById'])->name('advanced-student.get_guardian_by_id');
    
 });
