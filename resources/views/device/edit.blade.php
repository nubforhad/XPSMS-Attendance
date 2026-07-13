@extends('layouts.app')
@section('title','Edit Device')
@section('content')
<div class="container-fluid px-0">
   <div class="d-flex justify-content-between align-items-center mb-3">
      <div>
         <h4 class="mb-0">Edit Device</h4>
         <small class="text-muted">Update attendance device information</small>
      </div>
      <a href="{{ route('device.index') }}" class="btn btn-secondary">
      <i class="bi bi-arrow-left"></i>
      Back
      </a>
   </div>
   <div class="card shadow-sm">
      <div class="card-body">
         <form action="{{ route('device.update',$device->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
               <div class="col-md-6">
                  <label class="form-label">
                  Company <span class="text-danger">*</span>
                  </label>
                  <select name="company_id" class="form-select">
                     <option value="">
                        Select Company
                     </option>
                     @foreach($companies as $company)
                     <option value="{{ $company->id }}"
                     {{ old('company_id',$device->company_id)==$company->id?'selected':'' }}>
                     {{ $company->name }}
                     </option>
                     @endforeach
                  </select>
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Branch <span class="text-danger">*</span>
                  </label>
                  <select name="branch_id" class="form-select">
                     <option value="">
                        Select Branch
                     </option>
                     @foreach($branches as $branch)
                     <option value="{{ $branch->id }}"
                     {{ old('branch_id',$device->branch_id)==$branch->id?'selected':'' }}>
                     {{ $branch->name }}
                     </option>
                     @endforeach
                  </select>
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Device Name <span class="text-danger">*</span>
                  </label>
                  <input type="text"
                     name="device_name"
                     class="form-control"
                     value="{{ old('device_name',$device->device_name) }}">
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Device Serial Number <span class="text-danger">*</span>
                  </label>
                  <input type="text"
                     name="device_sn"
                     class="form-control"
                     value="{{ old('device_sn',$device->device_sn) }}">
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Device Type
                  </label>
                  <input type="text"
                     name="device_type"
                     class="form-control"
                     value="{{ old('device_type',$device->device_type) }}">
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  IP Address
                  </label>
                  <input type="text"
                     name="ip_address"
                     class="form-control"
                     value="{{ old('ip_address',$device->ip_address) }}">
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Port
                  </label>
                  <input type="text"
                     name="port"
                     class="form-control"
                     value="{{ old('port',$device->port) }}">
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Status
                  </label>
                  <select name="status" class="form-select">
                  <option value="active"
                  {{ old('status',$device->status)=='active'?'selected':'' }}>
                  Active
                  </option>
                  <option value="inactive"
                  {{ old('status',$device->status)=='inactive'?'selected':'' }}>
                  Inactive
                  </option>
                  </select>
               </div>
            </div>
            <div class="mt-4">
               <button type="submit" class="btn btn-primary">
               <i class="bi bi-save"></i>
               Update Device
               </button>
               <a href="{{ route('device.index') }}" class="btn btn-secondary">
               Cancel
               </a>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection