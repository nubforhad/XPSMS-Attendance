<?php

namespace App\Http\Controllers;


use App\Models\Company;
use Illuminate\Http\Request;


class CompanyController extends Controller
{


    public function index()
    {

        $companies = Company::latest()->paginate(10);


        return view('company.index',
        compact('companies'));

    }



    public function create()
    {

        return view('company.create');

    }



    public function store(Request $request)
    {


        $request->validate([

            'name'=>'required',
            'code'=>'required|unique:companies',
            'email'=>'nullable|email',
            'phone'=>'nullable',

        ]);



        Company::create($request->all());



        return redirect()
        ->route('company.index')
        ->with('success','Company created successfully');


    }




    public function edit(Company $company)
    {

        return view('company.edit',
        compact('company'));

    }



    public function update(Request $request, Company $company)
    {


        $request->validate([

            'name'=>'required',
            'code'=>'required|unique:companies,code,'.$company->id,

        ]);



        $company->update($request->all());



        return redirect()
        ->route('company.index')
        ->with('success','Company updated successfully');


    }



    public function destroy(Company $company)
    {

        $company->delete();


        return back()
        ->with('success','Company deleted successfully');


    }



}