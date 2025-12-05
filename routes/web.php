<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;

Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('/dashboard', [HomeController::class, 'dashboard'])
    ->middleware('auth')
    ->name('dashboard');

Route::middleware('auth')->group(function(){
    // Owner routes
    Route::middleware('role:owner')->prefix('owner')->name('owner.')->group(function(){
   
    Route::resource('companies', CompanyController::class)->only(['index','create','store','show']);

    });

    Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
            return view('profile.edit');
        })->name('profile.edit');
    });

    // Admin routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function(){
        Route::get('companies', [CompanyController::class,'select'])->name('companies.select');
        Route::post('company/{company}/enter', [CompanyController::class,'enter'])->name('company.enter');
        Route::get('company/{company}/employees', [EmployeeController::class,'index'])->name('company.employees');
        Route::get('company/{company}/employees/create', [EmployeeController::class,'create'])->name('employees.create');
        Route::post('company/{company}/employees', [EmployeeController::class,'store'])->name('employees.store');

        Route::post('company/{company}/attendance/scan', [AttendanceController::class,'scan'])->name('attendance.scan');
        Route::get('company/{company}/attendances', [AttendanceController::class,'index'])->name('attendances.index');
    });

    // Employee routes
    Route::middleware('role:employee')->prefix('employee')->name('employee.')->group(function(){
        Route::get('dashboard', [EmployeeController::class,'dashboard'])->name('dashboard');
        Route::get('company/{company}', [EmployeeController::class,'showCompany'])->name('company.show');
        Route::post('company/{company}/request-leave', [AttendanceController::class,'requestLeave'])->name('request.leave');
    });
});

require __DIR__.'/auth.php';
