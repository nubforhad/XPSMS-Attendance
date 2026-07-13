<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index(Request $request)
    {
        $query = Designation::with([
            'company',
            'department'
        ]);

        if($request->filled('search')){
            $query->where(function($q) use($request){

                $q->where('name','like','%'.$request->search.'%')
                  ->orWhere('code','like','%'.$request->search.'%');

            });
        }
        if($request->filled('company')){

            $query->where('company_id',$request->company);
        }
        if($request->filled('department')){

            $query->where('department_id',$request->department);
        }
        if($request->filled('status')){
            $query->where('status',$request->status);
        }
        $designations = $query
            ->latest()
            ->paginate(10);
        $companies = Company::where('status','active')
            ->get();
        $departments = Department::where('status','active')
            ->get();
        return view('designation.index',compact(
            'designations',
            'companies',
            'departments'
        ));

    } 
    public function create()
    {
        $companies = Company::where('status','active')
            ->get();


        $departments = Department::where('status','active')
            ->get();


        return view('designation.create',compact(
            'companies',
            'departments'
        ));
    } 
    public function store(Request $request)
    {
        $request->validate([

            'company_id'=>'required|exists:companies,id',

            'department_id'=>'required|exists:departments,id',

            'name'=>'required|max:255',

            'code'=>'required|unique:designations',

            'status'=>'required'

        ]);



        Designation::create($request->all());



        return redirect()
            ->route('designation.index')
            ->with('success','Designation created successfully.');

    } 
    public function edit(Designation $designation)
    {

        $companies = Company::where('status','active')
            ->get();


        $departments = Department::where('status','active')
            ->get();



        return view('designation.edit',compact(
            'designation',
            'companies',
            'departments'
        ));

    } 

    public function update(Request $request, Designation $designation)
    {
        $request->validate([

            'company_id'=>'required|exists:companies,id',

            'department_id'=>'required|exists:departments,id',

            'name'=>'required|max:255',

            'code'=>'required|unique:designations,code,'.$designation->id,

            'status'=>'required'

        ]); 
        $designation->update($request->all()); 
        return redirect()
            ->route('designation.index')
            ->with('success','Designation updated successfully.');

    } 
    public function destroy(Designation $designation)
    {

        $designation->delete(); 
        return redirect()
            ->back()
            ->with('success','Designation deleted successfully.');

    }
}