<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UidAttendanceController;

Route::post('/attendance/uid', [UidAttendanceController::class, 'storeFromIoT']);

Route::get('/last-uid', function () {
    return response()->json([
        'uid' => cache('last_scanned_uid')
    ]);
});

Route::get('/cache-test', function () {
    cache(['last_scanned_uid' => 'TEST123'], now()->addMinutes(5));
    return cache('last_scanned_uid');
});
