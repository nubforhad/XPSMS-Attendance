<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Company;
use App\Models\Branch;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index(Request $request)
    {
        $query = Device::with([
            'company',
            'branch'
        ]);

        if($request->filled('search')){

            $query->where(function($q) use($request){

                $q->where('device_name','like','%'.$request->search.'%')
                  ->orWhere('device_sn','like','%'.$request->search.'%');

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


        $devices = $query
            ->latest()
            ->paginate(10);


        $companies = Company::where('status','active')
            ->get();


        $branches = Branch::where('status','active')
            ->get();



        return view('device.index',compact(
            'devices',
            'companies',
            'branches'
        ));
    } 
    public function create()
    {
        $companies = Company::where('status','active')
            ->get();


        $branches = Branch::where('status','active')
            ->get();


        return view('device.create',compact(
            'companies',
            'branches'
        ));
    } 
    public function store(Request $request)
    {
        $request->validate([

            'company_id'=>'required|exists:companies,id',

            'branch_id'=>'required|exists:branches,id',

            'device_name'=>'required',

            'device_sn'=>'required|unique:devices',

            'device_type'=>'required',

            'status'=>'required'

        ]); 
        Device::create($request->all()); 
        return redirect()
            ->route('device.index')
            ->with('success','Device added successfully.');
    } 
    public function edit(Device $device)
    {
        $companies = Company::where('status','active')
            ->get();


        $branches = Branch::where('status','active')
            ->get();



        return view('device.edit',compact(
            'device',
            'companies',
            'branches'
        ));
    } 
    public function update(Request $request, Device $device)
    {
        $request->validate([

            'company_id'=>'required|exists:companies,id',

            'branch_id'=>'required|exists:branches,id',

            'device_name'=>'required',

            'device_sn'=>'required|unique:devices,device_sn,'.$device->id,

            'device_type'=>'required',

            'status'=>'required'

        ]); 
        $device->update($request->all()); 
        return redirect()
            ->route('device.index')
            ->with('success','Device updated successfully.');

    } 
    public function destroy(Device $device)
    {
        $device->delete();


        return redirect()
            ->back()
            ->with('success','Device deleted successfully.');
    }
}