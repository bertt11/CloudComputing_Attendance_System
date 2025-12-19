<?php
use App\Http\Controllers\Admin\UidAttendanceController;
use Illuminate\Support\Facades\Route;

Route::post('/attendance/uid', [UidAttendanceController::class, 'storeFromIoT']);
