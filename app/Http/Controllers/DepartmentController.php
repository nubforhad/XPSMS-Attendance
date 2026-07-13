<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Company;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Department::with('company');
        if($request->filled('search')){
            $query->where(function($q) use($request){
                $q->where('name','like','%'.$request->search.'%')
                  ->orWhere('code','like','%'.$request->search.'%');
            });
        }
        if($request->filled('company')){
            $query->where('company_id',$request->company);
        }
        if($request->filled('status')){
            $query->where('status',$request->status);
        }
        $departments = $query->latest()->paginate(10);
        $companies = Company::where('status','active')->get();
        return view('department.index',compact(
            'departments',
            'companies'
        ));
    }


    public function create()
    {
        $companies = Company::where('status','active')->get();
        return view('department.create',compact(
            'companies'
        ));
    } 
    public function store(Request $request)
    {
        $request->validate([
            'company_id'=>'required|exists:companies,id',
            'name'=>'required|max:255',
            'code'=>'required|unique:departments',
            'status'=>'required'
        ]);
        Department::create($request->all());
        return redirect()
            ->route('department.index')
            ->with('success','Department created successfully.');
    } 
    public function edit(Department $department)
    {
        $companies = Company::where('status','active')->get();
        return view('department.edit',compact(
            'department',
            'companies'
        ));
    } 
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'company_id'=>'required|exists:companies,id',
            'name'=>'required|max:255',
            'code'=>'required|unique:departments,code,'.$department->id,
            'status'=>'required'

        ]);
        $department->update($request->all());
        return redirect()
            ->route('department.index')
            ->with('success','Department updated successfully.');
    } 
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()
            ->back()
            ->with('success','Department deleted successfully.');
    }
}