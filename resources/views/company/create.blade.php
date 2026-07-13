@extends('layouts.app') @section('title','Add Company') @section('content')

<div class="card shadow-sm">
    <div class="card-header">
        <h5>Add Company</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('company.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label"> Company Name </label>

                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" />

                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label"> Company Code </label>

                    <input type="text" name="code" class="form-control" value="{{ old('code') }}" />

                    @error('code')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label"> Email </label>

                    <input type="email" name="email" class="form-control" />
                </div>

                <div class="col-md-6">
                    <label class="form-label"> Phone </label>

                    <input type="text" name="phone" class="form-control" />
                </div>

                <div class="col-md-12">
                    <label class="form-label"> Address </label>

                    <textarea name="address" class="form-control"></textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label"> Status </label>

                    <select name="status" class="form-select">
                        <option value="active">Active</option>

                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-success">Save</button>

                <a href="{{ route('company.index') }}" class="btn btn-secondary"> Back </a>
            </div>
        </form>
    </div>
</div>

@endsection
