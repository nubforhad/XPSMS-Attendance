<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Employee;
use App\Models\AttendanceLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceSyncController extends Controller
{
    public function receive(Request $request)
    {
        $request->validate([
            'device_sn'=>'required',
            'user_id'=>'required',
            'date'=>'required',
            'time'=>'required'
        ]);


        $device = Device::where('device_sn',$request->device_sn)
            ->first();


        if(!$device){

            return response()->json([
                'status'=>false,
                'message'=>'Device not found'
            ],404);

        } 
        $employee = Employee::where('device_user_id',$request->user_id)
            ->first(); 
        AttendanceLog::create([

            'device_id'=>$device->id,

            'employee_id'=>$employee?->id,

            'device_user_id'=>$request->user_id,

            'attendance_date'=>$request->date,

            'attendance_time'=>$request->time,

            'type'=>'check_in',

            'verify_type'=>$request->verify_type ?? 'finger'

        ]); 
        $device->update([

            'last_sync_at'=>now()

        ]); 
        return response()->json([

            'status'=>true,

            'message'=>'Attendance synced successfully'

        ]);

    }
}