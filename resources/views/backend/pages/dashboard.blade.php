@extends('backend.layouts.master')

@section('content')
@can('dashboard')
<!-- Today's Activity -->
<div class="card col-12 containing-card">
    <div class="card-header">
        <b>Today's Activity</b>
    </div>
    <div class="p-2 row">
        <!-- Today's Reservations -->
        <div class="col-md-3 col-sm-6">
            <div class="shadow card bg-light">
                <div class="card-body">
                    <h6 class="text-uppercase font-weight-bold">Today's Reservations</h6>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Total Counts -->
<div class="card col-12 containing-card">
    <div class="card-header">
        <b>Total Statistics</b>
    </div>
    <div class="p-2 row">
        <!-- Total Reservations -->
        <div class="col-md-3 col-sm-6">
            <div class="shadow card bg-light">
                <div class="card-body">
                    <h6 class="text-uppercase font-weight-bold">Total Reservations</h6>
                </div>
            </div>
        </div>
    </div>
</div>
@endcan
@endsection
