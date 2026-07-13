 @extends('layouts.app')
@section('title','Edit Branch')
@section('content')
<div class="container-fluid px-0">
   <div class="d-flex justify-content-between align-items-center mb-3">
      <div>
         <h4 class="mb-0">Edit Branch</h4>
         <small class="text-muted">Update branch information</small>
      </div>
      <a href="{{ route('branch.index') }}" class="btn btn-secondary">
      <i class="bi bi-arrow-left"></i>
      Back
      </a>
   </div>
   <div class="card shadow-sm">
      <div class="card-body">
         <form action="{{ route('branch.update',$branch->id) }}" method="POST">
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
                     {{ old('company_id',$branch->company_id)==$company->id?'selected':'' }}>
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
                     value="{{ old('name',$branch->name) }}">
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
                     value="{{ old('code',$branch->code) }}">
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
                     value="{{ old('email',$branch->email) }}">
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Phone
                  </label>
                  <input type="text"
                     name="phone"
                     class="form-control"
                     value="{{ old('phone',$branch->phone) }}">
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Mobile
                  </label>
                  <input type="text"
                     name="mobile"
                     class="form-control"
                     value="{{ old('mobile',$branch->mobile) }}">
               </div>
               <div class="col-md-12">
                  <label class="form-label">
                  Address
                  </label>
                  <textarea name="address"
                     class="form-control"
                     rows="3">{{ old('address',$branch->address) }}</textarea>
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Timezone
                  </label>
                  <input type="text"
                     name="timezone"
                     class="form-control"
                     value="{{ old('timezone',$branch->timezone) }}">
               </div>
               <div class="col-md-6">
                  <label class="form-label">
                  Status
                  </label>
                  <select name="status"
                     class="form-select">
                  <option value="active"
                  {{ old('status',$branch->status)=='active'?'selected':'' }}>
                  Active
                  </option>
                  <option value="inactive"
                  {{ old('status',$branch->status)=='inactive'?'selected':'' }}>
                  Inactive
                  </option>
                  </select>
               </div>
            </div>
            <div class="mt-4">
               <button type="submit" class="btn btn-primary">
               <i class="bi bi-save"></i>
               Update Branch
               </button>
               <a href="{{ route('branch.index') }}" class="btn btn-secondary">
               Cancel
               </a>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection