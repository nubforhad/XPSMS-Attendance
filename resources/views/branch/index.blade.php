@extends('layouts.app')
@section('title','Branches')
@section('content')
<div class="container-fluid px-0">
   {{-- Page Header --}}
   <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-3">
      <div>
         <h4 class="mb-0">
            Branches
         </h4>
         <small class="text-muted">
         Manage all branch information
         </small>
      </div>
      <div>
         <a href="{{ route('branch.create') }}"
            class="btn btn-primary">
         <i class="bi bi-plus-circle"></i>
         Add Branch
         </a>
      </div>
   </div>
   {{-- Success Message --}}
   @if(session('success'))
   <div class="alert alert-success alert-dismissible fade show">
      {{ session('success') }}
      <button type="button"
         class="btn-close"
         data-bs-dismiss="alert">
      </button>
   </div>
   @endif
   {{-- Filter Card --}}
   <div class="card shadow-sm mb-3">
      <div class="card-body">
         <form method="GET"
            action="{{ route('branch.index') }}">
            <div class="row g-2">
               {{-- Search --}}
               <div class="col-md-4">
                  <label class="form-label">
                  Search
                  </label>
                  <input type="text"
                     name="search"
                     class="form-control"
                     placeholder="Branch name/code/phone"
                     value="{{ request('search') }}">
               </div>
               {{-- Company Filter --}}
               <div class="col-md-3">
                  <label class="form-label">
                  Company
                  </label>
                  <select name="company"
                     class="form-select">
                     <option value="">
                        All Company
                     </option>
                     @foreach($companies as $company)
                     <option value="{{ $company->id }}"
                     {{ request('company')==$company->id ? 'selected':'' }}>
                     {{ $company->name }}
                     </option>
                     @endforeach
                  </select>
               </div>
               {{-- Status Filter --}}
               <div class="col-md-3">
                  <label class="form-label">
                  Status
                  </label>
                  <select name="status"
                     class="form-select">
                     <option value="">
                        All Status
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
               {{-- Button --}}
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
   {{-- Branch Table --}}
   <div class="card shadow-sm">
      <div class="card-body">
         <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
               <thead class="table-dark">
                  <tr>
                     <th width="50">
                        #
                     </th>
                     <th>
                        Company
                     </th>
                     <th>
                        Branch Name
                     </th>
                     <th>
                        Code
                     </th>
                     <th>
                        Phone
                     </th>
                     <th>
                        Status
                     </th>
                     <th width="150">
                        Action
                     </th>
                  </tr>
               </thead>
               <tbody>
                  @forelse($branches as $key=>$branch)
                  <tr>
                     <td>
                        {{ $branches->firstItem()+$key }}
                     </td>
                     <td>
                        {{ $branch->company->name ?? '-' }}
                     </td>
                     <td>
                        <strong>
                        {{ $branch->name }}
                        </strong>
                     </td>
                     <td>
                        <span class="badge bg-secondary">
                        {{ $branch->code }}
                        </span>
                     </td>
                     <td>
                        {{ $branch->phone ?? '-' }}
                     </td>
                     <td>
                        @if($branch->status == 'active')
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
                           <a href="{{ route('branch.edit',$branch->id) }}"
                              class="btn btn-warning btn-sm">
                           <i class="bi bi-pencil"></i>
                           </a>
                           <form action="{{ route('branch.destroy',$branch->id) }}"
                              method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit"
                                 class="btn btn-danger btn-sm"
                                 onclick="return confirm('Delete branch?')">
                              <i class="bi bi-trash"></i>
                              </button>
                           </form>
                        </div>
                     </td>
                  </tr>
                  @empty
                  <tr>
                     <td colspan="7"
                        class="text-center">
                        No Branch Found
                     </td>
                  </tr>
                  @endforelse
               </tbody>
            </table>
         </div>
         {{-- Pagination --}}
         <div class="mt-3">
            {{ $branches->withQueryString()->links() }}
         </div>
      </div>
   </div>
</div>
@endsection