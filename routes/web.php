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

Route::middleware(['auth:user'])->name('user.')->group(function () {

    Route::prefix('user')->name('user.')->group(function () {

        Route::controller(LoginController::class)->group(function () {
            Route::get('logout', 'logouts')->name('logout');
        });

        // Dashboard
        Route::controller(UserController::class)->middleware('permission:dashboard,view')->group(function () {
            Route::get('', 'index')->name('index');
        });

        // Attendance
        Route::prefix('attendance')
            ->middleware('permission:attendance,view')
            ->controller(AttendanceController::class)
            ->name('attendance.')
            ->group(function () {

                Route::get('', 'index')->name('index');
                Route::get('get', 'get')->name('get');

                Route::post('store', 'store')->middleware('permission:attendance,add')->name('store');

                Route::get('export', 'export')->name('export');
            });

        // Leaves
        Route::prefix('leaves')
            ->middleware('permission:leaves,view')
            ->controller(LeaveController::class)
            ->name('leaves.')
            ->group(function () {

                Route::get('', 'index')->name('index');
                Route::get('get', 'get')->name('get');

                Route::post('store', 'store')->middleware('permission:leaves,add')->name('store');

                Route::get('export', 'export')->name('export');
            });

        // Payroll
        Route::prefix('payroll')
            ->middleware('permission:payroll,view')
            ->controller(PayrollController::class)
            ->name('payroll.')
            ->group(function () {

                Route::get('', 'index')->name('index');
                Route::get('get', 'get')->name('get');

                Route::post('store', 'store')->middleware('permission:payroll,add')->name('store');

                Route::get('export', 'export')->name('export');
            });

        // Performance
        Route::prefix('performance')
            ->middleware('permission:performance,view')
            ->controller(PerformanceController::class)
            ->name('performance.')
            ->group(function () {

                Route::get('', 'index')->name('index');
                Route::get('get', 'get')->name('get');

                Route::post('store', 'store')->middleware('permission:performance,add')->name('store');

                Route::get('export', 'export')->name('export');
            });

        // Training
        Route::prefix('training')
            ->middleware('permission:training,view')
            ->controller(TraningController::class)
            ->name('training.')
            ->group(function () {

                Route::get('', 'index')->name('index');
                Route::get('get', 'get')->name('get');

                Route::post('store', 'store')->middleware('permission:training,add')->name('store');

                Route::get('export', 'export')->name('export');
            });

        // Document
        Route::prefix('document')
            ->middleware('permission:document,view')
            ->controller(DocumentController::class)
            ->name('document.')
            ->group(function () {

                Route::get('', 'index')->name('index');
                Route::get('get', 'get')->name('get');

                Route::post('store', 'store')->middleware('permission:document,add')->name('store');

                Route::delete('delete/{id}', 'delete')->middleware('permission:document,delete')->name('delete');

                Route::get('export', 'export')->name('export');
            });

        // Profile
        Route::prefix('profile')
            ->middleware('permission:profile,view')
            ->controller(ProfileController::class)
            ->name('profile.')
            ->group(function () {

                Route::get('', 'index')->name('index');

                Route::post('update', 'update')->middleware('permission:profile,edit')->name('update');

                Route::post('photo', 'uploadPhoto')->name('photo');

                Route::post('store', 'store')->name('store');
            });

        // Setting
        Route::prefix('setting')
            ->middleware('permission:setting,view')
            ->controller(SettingController::class)
            ->name('setting.')
            ->group(function () {

                Route::get('', 'index')->name('index');

                Route::post('update', 'update')->middleware('permission:setting,edit')->name('update');

                Route::post('store', 'store')->name('store');
            });

    });
});