<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceLog extends Model
{
    protected $fillable = [
        'device_id',
        'employee_id',
        'device_user_id',
        'attendance_date',
        'attendance_time',
        'type',
        'verify_type'
    ];


    public function device()
    {
        return $this->belongsTo(Device::class);
    }


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}