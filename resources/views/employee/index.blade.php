@extends('layouts.app')
@section('title','Employees')
@section('content')
<div class="container-fluid px-0">
   <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-3">
      <div>
         <h4 class="mb-0">
            Employees
         </h4>
         <small class="text-muted">
         Manage employee information
         </small>
      </div>
      <a href="{{ route('employee.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-circle"></i>
      Add Employee
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
         <form method="GET" action="{{ route('employee.index') }}">
            <div class="row g-2">
               <div class="col-md-3">
                  <label class="form-label">
                  Search
                  </label>
                  <input type="text"
                     name="search"
                     class="form-control"
                     placeholder="Name / Employee ID / Phone"
                     value="{{ request('search') }}">
               </div>
               <div class="col-md-3">
                  <label class="form-label">
                  Company
                  </label>
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
                  <label class="form-label">
                  Branch
                  </label>
                  <select name="branch" class="form-select">
                     <option value="">
                        All Branch
                     </option>
                     @foreach($branches as $branch)
                     <option value="{{ $branch->id }}"
                     {{ request('branch')==$branch->id?'selected':'' }}>
                     {{ $branch->name }}
                     </option>
                     @endforeach
                  </select>
               </div>
               <div class="col-md-2">
                  <label class="form-label">
                  Status
                  </label>
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
                     <th>Employee ID</th>
                     <th>Name</th>
                     <th>Company</th>
                     <th>Branch</th>
                     <th>Department</th>
                     <th>Designation</th>
                     <th>Device User ID</th>
                     <th>Status</th>
                     <th width="150">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse($employees as $key=>$employee)
                  <tr>
                     <td>
                        {{ $employees->firstItem()+$key }}
                     </td>
                     <td>
                        <span class="badge bg-secondary">
                        {{ $employee->employee_id }}
                        </span>
                     </td>
                     <td>
                        <strong>
                        {{ $employee->name }}
                        </strong>
                        <br>
                        <small class="text-muted">
                        {{ $employee->phone ?? '-' }}
                        </small>
                     </td>
                     <td>
                        {{ $employee->company->name ?? '-' }}
                     </td>
                     <td>
                        {{ $employee->branch->name ?? '-' }}
                     </td>
                     <td>
                        {{ $employee->department->name ?? '-' }}
                     </td>
                     <td>
                        {{ $employee->designation->name ?? '-' }}
                     </td>
                     <td>
                        @if($employee->device_user_id)
                        <span class="badge bg-info">
                        {{ $employee->device_user_id }}
                        </span>
                        @else
                        <span class="text-muted">
                        Not Assigned
                        </span>
                        @endif
                     </td>
                     <td>
                        @if($employee->status=='active')
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
                           <a href="{{ route('employee.edit',$employee->id) }}"
                              class="btn btn-warning btn-sm">
                           <i class="bi bi-pencil"></i>
                           </a>
                           <form action="{{ route('employee.destroy',$employee->id) }}"
                              method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit"
                                 class="btn btn-danger btn-sm"
                                 onclick="return confirm('Delete employee?')">
                              <i class="bi bi-trash"></i>
                              </button>
                           </form>
                        </div>
                     </td>
                  </tr>
                  @empty
                  <tr>
                     <td colspan="10" class="text-center">
                        No Employee Found
                     </td>
                  </tr>
                  @endforelse
               </tbody>
            </table>
         </div>
         <div class="mt-3">
            {{ $employees->withQueryString()->links() }}
         </div>
      </div>
   </div>
</div>
@endsection