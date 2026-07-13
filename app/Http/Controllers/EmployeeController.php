<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function index(Request $request)
    {
        $query = Employee::with([
            'company',
            'branch',
            'department',
            'designation'
        ]);
        if($request->filled('search')){
            $query->where(function($q) use($request){

                $q->where('name','like','%'.$request->search.'%')
                  ->orWhere('employee_id','like','%'.$request->search.'%')
                  ->orWhere('phone','like','%'.$request->search.'%');

            });

        }
        if($request->filled('company')){

            $query->where('company_id',$request->company);
        }
        if($request->filled('branch')){

            $query->where('branch_id',$request->branch);
        }
        if($request->filled('status')){

            $query->where('status',$request->status);
        }
        $employees = $query
            ->latest()
            ->paginate(10);
        $companies = Company::where('status','active')
            ->get();
        $branches = Branch::where('status','active')
            ->get();
        return view('employee.index',compact(
            'employees',
            'companies',
            'branches'
        ));
    } 
    public function create()
    {
        $companies = Company::where('status','active')->get();

        $branches = Branch::where('status','active')->get();

        $departments = Department::where('status','active')->get();

        $designations = Designation::where('status','active')->get();


        return view('employee.create',compact(
            'companies',
            'branches',
            'departments',
            'designations'
        ));
    } 
    public function store(Request $request)
    {

        $request->validate([

            'company_id'=>'required|exists:companies,id',

            'branch_id'=>'required|exists:branches,id',

            'employee_id'=>'required|unique:employees',

            'name'=>'required',

            'device_user_id'=>'nullable',

            'status'=>'required'

        ]); 
        Employee::create($request->all()); 
        return redirect()
            ->route('employee.index')
            ->with('success','Employee added successfully.');

    } 
    public function edit(Employee $employee)
    {

        $companies = Company::where('status','active')->get();

        $branches = Branch::where('status','active')->get();

        $departments = Department::where('status','active')->get();

        $designations = Designation::where('status','active')->get();



        return view('employee.edit',compact(
            'employee',
            'companies',
            'branches',
            'departments',
            'designations'
        ));

    } 
    public function update(Request $request, Employee $employee)
    {

        $request->validate([

            'company_id'=>'required|exists:companies,id',

            'branch_id'=>'required|exists:branches,id',

            'employee_id'=>'required|unique:employees,employee_id,'.$employee->id,

            'name'=>'required',

            'device_user_id'=>'nullable',

            'status'=>'required'

        ]); 
        $employee->update($request->all()); 
        return redirect()
            ->route('employee.index')
            ->with('success','Employee updated successfully.');

    } 
    public function destroy(Employee $employee)
    {

        $employee->delete(); 
        return redirect()
            ->back()
            ->with('success','Employee deleted successfully.');

    }

}