<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UidAttendanceController;

Route::post('/attendance/uid', [UidAttendanceController::class, 'storeFromIoT']);

Route::get('/last-uid', function () {
    return response()->json([
        'uid' => cache('last_scanned_uid')
    ]);
});
