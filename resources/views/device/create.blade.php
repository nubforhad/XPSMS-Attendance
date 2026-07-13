@extends('layouts.app')
@section('title','Add Device')
@section('content')
<div class="container-fluid px-0">
   <div class="d-flex justify-content-between align-items-center mb-3">
      <div>
         <h4 class="mb-0">Add Device</h4>
         <small class="text-muted">Register attendance device</small>
      </div>
      <a href="{{ route('device.index') }}" class="btn btn-secondary">
      <i class="bi bi-arrow-left"></i>
      Back
      </a>
   </div>
   <div class="card shadow-sm">
      <div class="card-body">
         <form action="{{ route('device.store') }}" method="POST">
            @csrf
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
                     {{ old('company_id')==$company->id?'selected':'' }}>
                     {{ $company->name }}
                     </option>
                     @endforeach
                  </select>
                  @error('company_id')
                  <div class="text-danger small">
                     {{ $message }}
                  </div>
                  @enderror
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
                     {{ old('branch_id')==$branch->id?'selected':'' }}>
                     {{ $branch->name }}
                     </option>
                     @endforeach
                  </select>
                  @error('branch_id')
                  <div class="text-danger small">
                     {{ $message }}
                  </div>
                  @enderror
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Device Name <span class="text-danger">*</span>
                  </label>
                  <input type="text"
                     name="device_name"
                     class="form-control"
                     placeholder="Example: Dhaka Main Gate"
                     value="{{ old('device_name') }}">
                  @error('device_name')
                  <div class="text-danger small">
                     {{ $message }}
                  </div>
                  @enderror
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Device Serial Number <span class="text-danger">*</span>
                  </label>
                  <input type="text"
                     name="device_sn"
                     class="form-control"
                     placeholder="ZKTeco Serial"
                     value="{{ old('device_sn') }}">
                  @error('device_sn')
                  <div class="text-danger small">
                     {{ $message }}
                  </div>
                  @enderror
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Device Type
                  </label>
                  <input type="text"
                     name="device_type"
                     class="form-control"
                     value="{{ old('device_type','ZKTeco K40') }}">
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  IP Address
                  </label>
                  <input type="text"
                     name="ip_address"
                     class="form-control"
                     placeholder="192.168.1.201"
                     value="{{ old('ip_address') }}">
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Port
                  </label>
                  <input type="text"
                     name="port"
                     class="form-control"
                     value="{{ old('port','4370') }}">
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Status
                  </label>
                  <select name="status" class="form-select">
                     <option value="active">
                        Active
                     </option>
                     <option value="inactive">
                        Inactive
                     </option>
                  </select>
               </div>
            </div>
            <div class="mt-4">
               <button type="submit" class="btn btn-success">
               <i class="bi bi-check-circle"></i>
               Save Device
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