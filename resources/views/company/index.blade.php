 @extends('layouts.app') @section('title','Companies') @section('content')

<div class="container-fluid px-0">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-3">
        <div>
            <h4 class="mb-0">Companies</h4>

            <small class="text-muted"> Manage all company information </small>
        </div>

        <a href="{{ route('company.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>

            Add Company
        </a>
    </div>

    @if(session('success'))

    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th width="50">#</th>

                            <th>Company Name</th>

                            <th>Code</th>

                            <th>Email</th>

                            <th>Phone</th>

                            <th>Status</th>

                            <th width="150">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($companies as $key=>$company)

                        <tr>
                            <td>{{ $companies->firstItem()+$key }}</td>

                            <td>
                                <strong> {{ $company->name }} </strong>
                            </td>

                            <td>
                                <span class="badge bg-secondary"> {{ $company->code }} </span>
                            </td>

                            <td>{{ $company->email ?? '-' }}</td>

                            <td>{{ $company->phone ?? '-' }}</td>

                            <td>
                                @if($company->status=='active')

                                <span class="badge bg-success"> Active </span>

                                @else

                                <span class="badge bg-danger"> Inactive </span>

                                @endif
                            </td>

                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('company.edit',$company->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('company.destroy',$company->id) }}" method="POST">
                                        @csrf @method('DELETE')

                                        <button
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete company?')"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="7" class="text-center">No Company Found</td>
                        </tr>

                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">{{ $companies->links() }}</div>
        </div>
    </div>
</div>

@endsection
