<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeOnboardingController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\user\AttendanceController;
use App\Http\Controllers\user\LeaveController;
use App\Http\Controllers\user\PayrollController;
use App\Http\Controllers\user\PerformanceController;
use App\Http\Controllers\user\TraningController;
use App\Http\Controllers\user\DocumentController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\user\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::post('/employee-onboarding/store', [EmployeeOnboardingController::class, 'store'])
//     ->name('employee.onboarding.store');

Route::prefix('employee')->controller(EmployeeController::class)->name('employee.')->group(function () {
    Route::get('view/{id}', 'view')->name('view');
});

Route::prefix('employee-onboarding')->group(function () {
    Route::match(['get', 'post'], '/store', [EmployeeOnboardingController::class, 'store']);
    // Route::post('/update', [EmployeeOnboardingController::class, 'update']);
});

Route::controller(LoginController::class)->group(function () {
    Route::get('user/login', 'userlogin')->name('userlogin');
    Route::post('user/logins', 'userlogins')->name('userlogins');
});


Route::prefix('user')->middleware(['auth:user'])->name('user.')->group(function () {

    Route::controller(LoginController::class)->group(function () {
        Route::get('logout', 'logouts')->name('logout');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('', 'index')->name('index');
    });

    Route::prefix('attendance')->controller(AttendanceController::class)->name('attendance.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('get', 'get')->name('get');
        Route::post('store', 'store')->name('store');
        Route::get('export', 'export')->name('export');

        // Route::get('request', 'request')->name('request');
    });

    Route::prefix('leaves')->controller(LeaveController::class)->name('leaves.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('get', 'get')->name('get');
        Route::post('store', 'store')->name('store');
        Route::get('export', 'export')->name('export');
    });

    Route::prefix('payroll')->controller(PayrollController::class)->name('payroll.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('get', 'get')->name('get');
        Route::post('store', 'store')->name('store');
        Route::get('export', 'export')->name('export');
    });

    Route::prefix('performance')->controller(PerformanceController::class)->name('performance.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('get', 'get')->name('get');
        Route::post('store', 'store')->name('store');
        Route::get('export', 'export')->name('export');
    });

    Route::prefix('training')->controller(TraningController::class)->name('training.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('get', 'get')->name('get');
        Route::post('store', 'store')->name('store');
        Route::get('export', 'export')->name('export');
    });

    Route::prefix('document')->controller(DocumentController::class)->name('document.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('get', 'get')->name('get');
        Route::delete('delete/{id}', 'delete')->name('delete');
        Route::post('store', 'store')->name('store');
        Route::get('export', 'export')->name('export');
    });

    Route::prefix('profile')->controller(ProfileController::class)->name('profile.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('update', 'update')->name('update');
        Route::post('photo', 'uploadPhoto')->name('photo');
        Route::post('store', 'store')->name('store');
    });

    Route::prefix('setting')->controller(SettingController::class)->name('setting.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('update', 'update')->name('update');
        Route::post('store', 'store')->name('store');
    });

});
