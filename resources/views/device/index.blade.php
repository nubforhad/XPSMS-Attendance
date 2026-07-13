@extends('layouts.app')
@section('title','Devices')
@section('content')
<div class="container-fluid px-0">
   <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-3">
      <div>
         <h4 class="mb-0">Devices</h4>
         <small class="text-muted">Manage attendance devices</small>
      </div>
      <a href="{{ route('device.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-circle"></i>
      Add Device
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
         <form method="GET" action="{{ route('device.index') }}">
            <div class="row g-2">
               <div class="col-md-3">
                  <label class="form-label">
                  Search
                  </label>
                  <input type="text"
                     name="search"
                     class="form-control"
                     placeholder="Device name / serial"
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
                     <th>Company</th>
                     <th>Branch</th>
                     <th>Device Name</th>
                     <th>Serial No</th>
                     <th>Type</th>
                     <th>Last Sync</th>
                     <th>Status</th>
                     <th width="150">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse($devices as $key=>$device)
                  <tr>
                     <td>
                        {{ $devices->firstItem()+$key }}
                     </td>
                     <td>
                        {{ $device->company->name ?? '-' }}
                     </td>
                     <td>
                        {{ $device->branch->name ?? '-' }}
                     </td>
                     <td>
                        <strong>
                        {{ $device->device_name }}
                        </strong>
                     </td>
                     <td>
                        <span class="badge bg-secondary">
                        {{ $device->device_sn }}
                        </span>
                     </td>
                     <td>
                        {{ $device->device_type }}
                     </td>
                     <td>
                        @if($device->last_sync_at)
                        {{ \Carbon\Carbon::parse($device->last_sync_at)->format('d M Y h:i A') }}
                        @else
                        <span class="text-muted">
                        Not Synced
                        </span>
                        @endif
                     </td>
                     <td>
                        @if($device->status=='active')
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
                           <a href="{{ route('device.edit',$device->id) }}"
                              class="btn btn-warning btn-sm">
                           <i class="bi bi-pencil"></i>
                           </a>
                           <form action="{{ route('device.destroy',$device->id) }}"
                              method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit"
                                 class="btn btn-danger btn-sm"
                                 onclick="return confirm('Delete device?')">
                              <i class="bi bi-trash"></i>
                              </button>
                           </form>
                        </div>
                     </td>
                  </tr>
                  @empty
                  <tr>
                     <td colspan="9" class="text-center">
                        No Device Found
                     </td>
                  </tr>
                  @endforelse
               </tbody>
            </table>
         </div>
         <div class="mt-3">
            {{ $devices->withQueryString()->links() }}
         </div>
      </div>
   </div>
</div>
@endsection