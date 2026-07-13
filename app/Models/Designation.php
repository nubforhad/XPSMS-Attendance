<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $fillable = [
        'company_id',
        'department_id',
        'name',
        'code',
        'description',
        'status'
    ];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }


    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}