@extends('layouts.app') @section('title','Edit Company') @section('content')

<div class="card shadow-sm">
    <div class="card-header">
        <h5>Edit Company</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('company.update',$company->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label"> Company Name </label>

                    <input type="text" name="name" class="form-control" value="{{ $company->name }}" />
                </div>

                <div class="col-md-6">
                    <label class="form-label"> Company Code </label>

                    <input type="text" name="code" class="form-control" value="{{ $company->code }}" />
                </div>

                <div class="col-md-6">
                    <label class="form-label"> Email </label>

                    <input type="email" name="email" class="form-control" value="{{ $company->email }}" />
                </div>

                <div class="col-md-6">
                    <label class="form-label"> Phone </label>

                    <input type="text" name="phone" class="form-control" value="{{ $company->phone }}" />
                </div>

                <div class="col-md-12">
                    <label class="form-label"> Address </label>

                    <textarea name="address" class="form-control">{{ $company->address }}</textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label"> Status </label>

                    <select name="status" class="form-select">
                        <option value="active" @if($company->status=='active') selected @endif> Active</option>

                        <option value="inactive" @if($company->status=='inactive') selected @endif> Inactive</option>
                    </select>
                </div>
            </div>

            <br />

            <button class="btn btn-primary">Update</button>

            <a href="{{ route('company.index') }}" class="btn btn-secondary"> Back </a>
        </form>
    </div>
</div>

@endsection
