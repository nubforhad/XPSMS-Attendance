@extends('layouts.app') @section('title','Dashboard') @section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">Dashboard</h3>
</div>

<div class="row g-3">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Total Company</p>

                        <h3>0</h3>
                    </div>

                    <div class="fs-2 text-primary">
                        <i class="bi bi-building"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Total Branch</p>

                        <h3>0</h3>
                    </div>

                    <div class="fs-2 text-success">
                        <i class="bi bi-diagram-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Total Device</p>

                        <h3>0</h3>
                    </div>

                    <div class="fs-2 text-warning">
                        <i class="bi bi-cpu"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Today's Attendance</p>

                        <h3>0</h3>
                    </div>

                    <div class="fs-2 text-danger">
                        <i class="bi bi-fingerprint"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
