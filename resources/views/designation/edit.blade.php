@extends('layouts.app')
@section('title','Edit Designation')
@section('content')
<div class="container-fluid px-0">
<div class="d-flex justify-content-between align-items-center mb-3">
   <div>
      <h4 class="mb-0">Edit Designation</h4>
      <small class="text-muted">Update designation information</small>
   </div>
   <a href="{{ route('designation.index') }}" class="btn btn-secondary">
   <i class="bi bi-arrow-left"></i>
   Back
   </a>
</div>
<div class="card shadow-sm">
   <div class="card-body">
      <form action="{{ route('designation.update',$designation->id) }}" method="POST">
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
                  {{ old('company_id',$designation->company_id)==$company->id?'selected':'' }}>
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
               Department <span class="text-danger">*</span>
               </label>
               <select name="department_id" class="form-select">
                  <option value="">
                     Select Department
                  </option>
                  @foreach($departments as $department)
                  <option value="{{ $department->id }}"
                  {{ old('department_id',$designation->department_id)==$department->id?'selected':'' }}>
                  {{ $department->name }}
                  </option>
                  @endforeach
               </select>
               @error('department_id')
               <div class="text-danger small">
                  {{ $message }}
                  \end{div}
                  @enderror
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Designation Name <span class="text-danger">*</span>
                  </label>
                  <input type="text"
                     name="name"
                     class="form-control"
                     value="{{ old('name',$designation->name) }}">
                  @error('name')
                  <div class="text-danger small">
                     {{ $message }}
                  </div>
                  @enderror
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Designation Code <span class="text-danger">*</span>
                  </label>
                  <input type="text"
                     name="code"
                     class="form-control"
                     value="{{ old('code',$designation->code) }}">
                  @error('code')
                  <div class="text-danger small">
                     {{ $message }}
                  </div>
                  @enderror
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Status
                  </label>
                  <select name="status" class="form-select">
                  <option value="active"
                  {{ old('status',$designation->status)=='active'?'selected':'' }}>
                  Active
                  </option>
                  <option value="inactive"
                  {{ old('status',$designation->status)=='inactive'?'selected':'' }}>
                  Inactive
                  </option>
                  </select>
               </div>
               <div class="col-md-12">
                  <label class="form-label">
                  Description
                  </label>
                  <textarea name="description"
                     class="form-control"
                     rows="4">{{ old('description',$designation->description) }}</textarea>
               </div>
            </div>
            <div class="mt-4">
               <button type="submit" class="btn btn-primary">
               <i class="bi bi-save"></i>
               Update Designation
               </button>
               <a href="{{ route('designation.index') }}"
                  class="btn btn-secondary">
               Cancel
               </a>
            </div>
      </form>
      </div>
   </div>
</div>
@endsection