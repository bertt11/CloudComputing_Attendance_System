<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeDashboardController;
use App\Http\Controllers\EmployeePermissionController;


Route::get('/', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    return match (Auth::user()->role) {
        'owner'    => redirect()->route('owner.dashboard'),
        'admin'    => redirect()->route('admin.dashboard'),
        'employee' => redirect()->route('employee.dashboard'),
        default    => abort(403),
    };
});

Route::middleware(['auth', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {

    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // companies
    Route::get('/companies', [CompanyController::class, 'index'])
        ->name('companies.index');

    Route::get('/companies/create', [CompanyController::class, 'create'])
        ->name('companies.create');

    Route::post('/companies', [CompanyController::class, 'store'])
        ->name('companies.store');

    Route::get('/companies/{company}', [CompanyController::class, 'show'])
        ->name('companies.show');

    // employees
    Route::get('/companies/{company}/employees/create',
        [EmployeeController::class, 'create'])
        ->name('employees.create');

    Route::post('/companies/{company}/employees',
        [EmployeeController::class, 'store'])
        ->name('employees.store');

    Route::patch('/employees/{employee}/role',
        [EmployeeController::class, 'updateRole'])
        ->name('employees.role');
});


        Route::middleware(['auth', 'role:admin'])->group(function () {

            Route::get('/admin/dashboard',
                [App\Http\Controllers\Admin\AdminDashboardController::class, 'index']
            )->name('admin.dashboard');

            Route::get('/admin/attendances',
                [App\Http\Controllers\Admin\AttendanceController::class, 'index']
            )->name('admin.attendances.index');


            Route::patch(
                '/admin/attendances/{attendance}',
                [\App\Http\Controllers\Admin\AttendanceController::class, 'update']
            )->name('admin.attendances.update');

            //approval izin
            Route::get('/admin/permissions', 
                [App\Http\Controllers\Admin\PermissionApprovalController::class, 'index']
            )->name('admin.permissions.index');

            Route::post('/admin/permissions/{attendance}/approve', 
                [App\Http\Controllers\Admin\PermissionApprovalController::class, 'approve']
            )->name('admin.permissions.approve');

            Route::post('/admin/permissions/{attendance}/reject', 
                [App\Http\Controllers\Admin\PermissionApprovalController::class, 'reject']
            )->name('admin.permissions.reject');

        });

    Route::middleware(['auth','role:employee'])
        ->prefix('employee')
        ->name('employee.')
        ->group(function () {

        Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/permission', [EmployeePermissionController::class, 'create'])
            ->name('permission.create');

        Route::post('/permission', [EmployeePermissionController::class, 'store'])
            ->name('permission.store');
    });


require __DIR__.'/auth.php';
