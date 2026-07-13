<?php

use App\Http\Controllers\AttendanceSyncController;


Route::post('/device/attendance', [AttendanceSyncController::class,'receive']);