@extends('layouts.app')
@section('title','Edit Employee')
@section('content')
<div class="container-fluid px-0">
   <div class="d-flex justify-content-between align-items-center mb-3">
      <div>
         <h4 class="mb-0">Edit Employee</h4>
         <small class="text-muted">Update employee information</small>
      </div>
      <a href="{{ route('employee.index') }}" class="btn btn-secondary">
      <i class="bi bi-arrow-left"></i>
      Back
      </a>
   </div>
   <div class="card shadow-sm">
      <div class="card-body">
         <form action="{{ route('employee.update',$employee->id) }}" method="POST">
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
                     {{ old('company_id',$employee->company_id)==$company->id?'selected':'' }}>
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
                     {{ old('branch_id',$employee->branch_id)==$branch->id?'selected':'' }}>
                     {{ $branch->name }}
                     </option>
                     @endforeach
                  </select>
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Department
                  </label>
                  <select name="department_id" class="form-select">
                     <option value="">
                        Select Department
                     </option>
                     @foreach($departments as $department)
                     <option value="{{ $department->id }}"
                     {{ old('department_id',$employee->department_id)==$department->id?'selected':'' }}>
                     {{ $department->name }}
                     </option>
                     @endforeach
                  </select>
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Designation
                  </label>
                  <select name="designation_id" class="form-select">
                     <option value="">
                        Select Designation
                     </option>
                     @foreach($designations as $designation)
                     <option value="{{ $designation->id }}"
                     {{ old('designation_id',$employee->designation_id)==$designation->id?'selected':'' }}>
                     {{ $designation->name }}
                     </option>
                     @endforeach
                  </select>
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Employee ID <span class="text-danger">*</span>
                  </label>
                  <input type="text"
                     name="employee_id"
                     class="form-control"
                     value="{{ old('employee_id',$employee->employee_id) }}">
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Employee Name <span class="text-danger">*</span>
                  </label>
                  <input type="text"
                     name="name"
                     class="form-control"
                     value="{{ old('name',$employee->name) }}">
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Phone
                  </label>
                  <input type="text"
                     name="phone"
                     class="form-control"
                     value="{{ old('phone',$employee->phone) }}">
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Email
                  </label>
                  <input type="email"
                     name="email"
                     class="form-control"
                     value="{{ old('email',$employee->email) }}">
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Device User ID
                  </label>
                  <input type="text"
                     name="device_user_id"
                     class="form-control"
                     value="{{ old('device_user_id',$employee->device_user_id) }}">
                  <small class="text-muted">
                  Same ID from ZKTeco K40
                  </small>
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Joining Date
                  </label>
                  <input type="date"
                     name="joining_date"
                     class="form-control"
                     value="{{ old('joining_date',$employee->joining_date) }}">
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Status
                  </label>
                  <select name="status" class="form-select">
                  <option value="active"
                  {{ old('status',$employee->status)=='active'?'selected':'' }}>
                  Active
                  </option>
                  <option value="inactive"
                  {{ old('status',$employee->status)=='inactive'?'selected':'' }}>
                  Inactive
                  </option>
                  </select>
               </div>
            </div>
            <div class="mt-4">
               <button type="submit" class="btn btn-primary">
               <i class="bi bi-save"></i>
               Update Employee
               </button>
               <a href="{{ route('employee.index') }}" class="btn btn-secondary">
               Cancel
               </a>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection