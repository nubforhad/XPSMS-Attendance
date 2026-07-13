@extends('layouts.app')
@section('title','Departments')
@section('content')
<div class="container-fluid px-0">
   <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-3">
      <div>
         <h4 class="mb-0">Departments</h4>
         <small class="text-muted">Manage all department information</small>
      </div>
      <div>
         <a href="{{ route('department.create') }}" class="btn btn-primary">
         <i class="bi bi-plus-circle"></i>
         Add Department
         </a>
      </div>
   </div>
   @if(session('success'))
   <div class="alert alert-success alert-dismissible fade show">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
   </div>
   @endif
   <div class="card shadow-sm mb-3">
      <div class="card-body">
         <form method="GET" action="{{ route('department.index') }}">
            <div class="row g-2">
               <div class="col-md-4">
                  <label class="form-label">Search</label>
                  <input type="text"
                     name="search"
                     class="form-control"
                     placeholder="Department name/code"
                     value="{{ request('search') }}">
               </div>
               <div class="col-md-3">
                  <label class="form-label">Company</label>
                  <select name="company" class="form-select">
                     <option value="">All Company</option>
                     @foreach($companies as $company)
                     <option value="{{ $company->id }}"
                     {{ request('company')==$company->id?'selected':'' }}>
                     {{ $company->name }}
                     </option>
                     @endforeach
                  </select>
               </div>
               <div class="col-md-3">
                  <label class="form-label">Status</label>
                  <select name="status" class="form-select">
                     <option value="">All Status</option>
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
                     <th>Department Name</th>
                     <th>Code</th>
                     <th>Status</th>
                     <th width="150">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse($departments as $key=>$department)
                  <tr>
                     <td>
                        {{ $departments->firstItem()+$key }}
                     </td>
                     <td>
                        {{ $department->company->name ?? '-' }}
                     </td>
                     <td>
                        <strong>
                        {{ $department->name }}
                        </strong>
                     </td>
                     <td>
                        <span class="badge bg-secondary">
                        {{ $department->code }}
                        </span>
                     </td>
                     <td>
                        @if($department->status=='active')
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
                           <a href="{{ route('department.edit',$department->id) }}"
                              class="btn btn-warning btn-sm">
                           <i class="bi bi-pencil"></i>
                           </a>
                           <form action="{{ route('department.destroy',$department->id) }}"
                              method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit"
                                 class="btn btn-danger btn-sm"
                                 onclick="return confirm('Delete department?')">
                              <i class="bi bi-trash"></i>
                              </button>
                           </form>
                        </div>
                     </td>
                  </tr>
                  @empty
                  <tr>
                     <td colspan="6" class="text-center">
                        No Department Found
                     </td>
                  </tr>
                  @endforelse
               </tbody>
            </table>
         </div>
         <div class="mt-3">
            {{ $departments->withQueryString()->links() }}
         </div>
      </div>
   </div>
</div>
@endsection