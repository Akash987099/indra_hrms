<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeOnboardingController;
use App\Http\Controllers\EmployeeController;

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

    Route::controller(UserController::class)->group(function () {
        Route::get('', 'index')->name('index');
    });
    
});

