<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

protected $fillable=[

'company_id',
'branch_id',
'department_id',
'designation_id',
'employee_id',
'name',
'phone',
'email',
'finger_id',
'device_user_id',
'joining_date',
'status'

];


public function company()
{
    return $this->belongsTo(Company::class);
}


public function branch()
{
    return $this->belongsTo(Branch::class);
}


public function department()
{
    return $this->belongsTo(Department::class);
}


public function designation()
{
    return $this->belongsTo(Designation::class);
}


}