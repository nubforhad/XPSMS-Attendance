<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'company_id',
        'branch_id',
        'device_name',
        'device_sn',
        'device_type',
        'ip_address',
        'port',
        'status',
        'last_sync_at'
    ];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }


    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}