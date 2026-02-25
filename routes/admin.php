<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SettingController;

Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('logins', 'logins')->name('logins');
});

Route::middleware(['auth:admin'])->group(function () {

    Route::controller(LoginController::class)->group(function () {
        Route::get('logout', 'logout')->name('logout');
    });

    Route::controller(AdminController::class)->group(function () {
        Route::get('', 'index')->name('index');
    });

    Route::prefix('employee')->controller(EmployeeController::class)->name('employee.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::post('update/{id}', 'update')->name('update');
        Route::get('onboarding', 'onboarding')->name('onboarding');
        Route::get('transfer/{id}', 'transfer')->name('transfer');
        Route::get('view/{id}', 'view')->name('view');
        Route::delete('delete/{id}', 'delete')->name('delete');
        // approval
        Route::post('approval', 'approval')->name('approval');
        Route::post('status', 'updateStatus')->name('status');

        // File
        Route::get('file/{id}', 'file')->name('file');
        Route::post('upload', 'upload')->name('upload');
    });

    Route::prefix('department')->controller(DepartmentController::class)->name('department.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('list', 'list')->name('list');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('store', 'store')->name('store');
        Route::post('update/{id}', 'update')->name('update');
        Route::delete('delete/{id}', 'delete')->name('delete');
    });

    Route::prefix('designation')->controller(DesignationController::class)->name('designation.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('list', 'list')->name('list');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('store', 'store')->name('store');
        Route::post('update/{id}', 'update')->name('update');
        Route::delete('delete/{id}', 'delete')->name('delete');
    });

    Route::prefix('attendance')->controller(AttendanceController::class)->name('attendance.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::get('export', 'export')->name('export');
        Route::post('/update/{id}', 'update')->name('update');
        Route::post('/delete/{id}', 'destroy')->name('delete');
    });

    Route::prefix('payroll')->controller(PayrollController::class)->name('payroll.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('process', 'process')->name('process');
        Route::get('payslips', 'payslips')->name('payslips');
    });

    Route::prefix('leave')->controller(LeaveController::class)->name('leave.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::post('{id}/status', 'updateStatus')->name('status');
    });

    Route::prefix('shift')->controller(ShiftController::class)->name('shift.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('generate', 'generate')->name('generate');
        Route::post('publish', 'publish')->name('publish');
        Route::get('load', 'load')->name('load');
    });

    Route::prefix('task')->controller(TaskController::class)->name('task.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::post('{id}/status', 'updateStatus')->name('status');
        Route::post('{id}/delete', 'destroy')->name('delete');
    });

    Route::prefix('performance')->controller(PerformanceController::class)->name('performance.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('/kpi', 'storeKpi')->name('kpi.store');
        Route::get('/data', 'performanceData')->name('data');
    });

    Route::prefix('report')->controller(ReportController::class)->name('report.')->group(function () {
        Route::get('', 'index')->name('index');
    });

    Route::prefix('module')->controller(ModuleController::class)->name('module.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::get('/get/{id}', 'getPermissions')->name('get');
    });

    Route::prefix('setting')->controller(SettingController::class)->name('setting.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('update', 'update')->name('update');
    });

});
