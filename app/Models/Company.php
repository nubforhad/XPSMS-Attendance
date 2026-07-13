<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $fillable = [

        'name',
        'code',
        'email',
        'phone',
        'address',
        'logo',
        'status'

    ];

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function designations()
    {
        return $this->hasMany(Designation::class);
    }

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

}