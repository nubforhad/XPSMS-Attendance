@extends('layouts.app')
@section('title','Add Branch')
@section('content')
<div class="container-fluid px-0">
   <div class="d-flex justify-content-between align-items-center mb-3">
      <div>
         <h4 class="mb-0">Add Branch</h4>
         <small class="text-muted">Create new branch</small>
      </div>
      <a href="{{ route('branch.index') }}" class="btn btn-secondary">
      <i class="bi bi-arrow-left"></i>
      Back
      </a>
   </div>
   <div class="card shadow-sm">
      <div class="card-body">
         <form action="{{ route('branch.store') }}" method="POST">
            @csrf
            <div class="row g-3">
               <div class="col-md-6">
                  <label class="form-label">
                  Company <span class="text-danger">*</span>
                  </label>
                  <select name="company_id" class="form-select">
                     <option value="">Select Company</option>
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
                  Branch Name <span class="text-danger">*</span>
                  </label>
                  <input type="text"
                     name="name"
                     class="form-control"
                     value="{{ old('name') }}">
                  @error('name')
                  <div class="text-danger small">
                     {{ $message }}
                  </div>
                  @enderror
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Branch Code <span class="text-danger">*</span>
                  </label>
                  <input type="text"
                     name="code"
                     class="form-control"
                     value="{{ old('code') }}">
                  @error('code')
                  <div class="text-danger small">
                     {{ $message }}
                  </div>
                  @enderror
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Email
                  </label>
                  <input type="email"
                     name="email"
                     class="form-control"
                     value="{{ old('email') }}">
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Phone
                  </label>
                  <input type="text"
                     name="phone"
                     class="form-control"
                     value="{{ old('phone') }}">
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Mobile
                  </label>
                  <input type="text"
                     name="mobile"
                     class="form-control"
                     value="{{ old('mobile') }}">
               </div>
               <div class="col-md-12">
                  <label class="form-label">
                  Address
                  </label>
                  <textarea name="address"
                     class="form-control"
                     rows="3">{{ old('address') }}</textarea>
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Timezone
                  </label>
                  <input type="text"
                     name="timezone"
                     class="form-control"
                     value="{{ old('timezone','Asia/Dhaka') }}">
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Status
                  </label>
                  <select name="status"
                     class="form-select">
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
               <button type="submit"
                  class="btn btn-success">
               <i class="bi bi-check-circle"></i>
               Save Branch
               </button>
               <a href="{{ route('branch.index') }}"
                  class="btn btn-secondary">
               Cancel
               </a>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection