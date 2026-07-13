@extends('layouts.app')
@section('title','Designations')
@section('content')
<div class="container-fluid px-0">
   <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-3">
      <div>
         <h4 class="mb-0">Designations</h4>
         <small class="text-muted">Manage all designation information</small>
      </div>
      <a href="{{ route('designation.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-circle"></i>
      Add Designation
      </a>
   </div>
   @if(session('success'))
   <div class="alert alert-success alert-dismissible fade show">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
   </div>
   @endif
   <div class="card shadow-sm mb-3">
      <div class="card-body">
         <form method="GET" action="{{ route('designation.index') }}">
            <div class="row g-2">
               <div class="col-md-3">
                  <label class="form-label">Search</label>
                  <input type="text"
                     name="search"
                     class="form-control"
                     placeholder="Name / Code"
                     value="{{ request('search') }}">
               </div>
               <div class="col-md-3">
                  <label class="form-label">Company</label>
                  <select name="company" class="form-select">
                     <option value="">
                        All Company
                     </option>
                     @foreach($companies as $company)
                     <option value="{{ $company->id }}"
                     {{ request('company')==$company->id?'selected':'' }}>
                     {{ $company->name }}
                     </option>
                     @endforeach
                  </select>
               </div>
               <div class="col-md-2">
                  <label class="form-label">Department</label>
                  <select name="department" class="form-select">
                     <option value="">
                        All Department
                     </option>
                     @foreach($departments as $department)
                     <option value="{{ $department->id }}"
                     {{ request('department')==$department->id?'selected':'' }}>
                     {{ $department->name }}
                     </option>
                     @endforeach
                  </select>
               </div>
               <div class="col-md-2">
                  <label class="form-label">Status</label>
                  <select name="status" class="form-select">
                     <option value="">
                        All
                     </option>
                     <option value="active"
                     {{ request('status')=='active'?'selected':'' }}>
                     Active
                     </option>
                     <option value="inactive"
                     {{ request('status')=='inactive'?'selected':'' }}>
                     Inactive
                     </option>
                  </select>
               </div>
               <div class="col-md-2 d-flex align-items-end">
                  <button class="btn btn-dark w-100">
                  <i class="bi bi-search"></i>
                  Search
                  </button>
               </div>
            </div>
         </form>
      </div>
   </div>
   <div class="card shadow-sm">
      <div class="card-body">
         <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
               <thead class="table-dark">
                  <tr>
                     <th width="50">#</th>
                     <th>Company</th>
                     <th>Department</th>
                     <th>Designation</th>
                     <th>Code</th>
                     <th>Status</th>
                     <th width="150">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse($designations as $key=>$designation)
                  <tr>
                     <td>
                        {{ $designations->firstItem()+$key }}
                     </td>
                     <td>
                        {{ $designation->company->name ?? '-' }}
                     </td>
                     <td>
                        {{ $designation->department->name ?? '-' }}
                     </td>
                     <td>
                        <strong>
                        {{ $designation->name }}
                        </strong>
                     </td>
                     <td>
                        <span class="badge bg-secondary">
                        {{ $designation->code }}
                        </span>
                     </td>
                     <td>
                        @if($designation->status=='active')
                        <span class="badge bg-success">
                        Active
                        </span>
                        @else
                        <span class="badge bg-danger">
                        Inactive
                        </span>
                        @endif
                     </td>
                     <td>
                        <div class="d-flex gap-1">
                           <a href="{{ route('designation.edit',$designation->id) }}"
                              class="btn btn-warning btn-sm">
                           <i class="bi bi-pencil"></i>
                           </a>
                           <form action="{{ route('designation.destroy',$designation->id) }}"
                              method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit"
                                 class="btn btn-danger btn-sm"
                                 onclick="return confirm('Delete designation?')">
                              <i class="bi bi-trash"></i>
                              </button>
                           </form>
                        </div>
                     </td>
                  </tr>
                  @empty
                  <tr>
                     <td colspan="7" class="text-center">
                        No Designation Found
                     </td>
                  </tr>
                  @endforelse
               </tbody>
            </table>
         </div>
         <div class="mt-3">
            {{ $designations->withQueryString()->links() }}
         </div>
      </div>
   </div>
</div>
@endsection