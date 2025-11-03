@extends('backend.layouts.master')

@section('content')

@role('Student')
<div class="row g-3">
    <!-- Your Class -->
    <div class="col-md-3 col-sm-6">
        <div class="shadow card border-left-primary">
            <div class="text-center card-body">
                <i class="mb-2 bi bi-building fs-2 text-primary"></i>
                <h6 class="text-uppercase font-weight-bold">Your Class</h6>
                <p class="mb-0">{{ auth()->user()->student->class->name ?? '-' }}</p>
            </div>
        </div>
    </div>

    <!-- Your Section -->
    <div class="col-md-3 col-sm-6">
        <div class="shadow card border-left-success">
            <div class="text-center card-body">
                <i class="mb-2 bi bi-diagram-3 fs-2 text-success"></i>
                <h6 class="text-uppercase font-weight-bold">Your Section</h6>
                <p class="mb-0">{{ auth()->user()->student->section->name ?? '-' }}</p>
            </div>
        </div>
    </div>

    <!-- Subjects Assigned -->
    <div class="col-md-3 col-sm-6">
        <div class="shadow card border-left-info">
            <div class="text-center card-body">
                <i class="mb-2 bi bi-journal-bookmark fs-2 text-info"></i>
                <h6 class="text-uppercase font-weight-bold">Subjects Assigned</h6>
                <p class="mb-0 text-truncate">
                    @foreach(auth()->user()->student->class->subjects ?? [] as $subject)
                        {{ $subject->name }}@if(!$loop->last), @endif
                    @endforeach
                </p>
            </div>
        </div>
    </div>

    <!-- Your DOB -->
    <div class="col-md-3 col-sm-6">
        <div class="shadow card border-left-warning">
            <div class="text-center card-body">
                <i class="mb-2 bi bi-calendar fs-2 text-warning"></i>
                <h6 class="text-uppercase font-weight-bold">Your DOB</h6>
                <p class="mb-0">{{ auth()->user()->student->dob ?? '-' }}</p>
            </div>
        </div>
    </div>
</div>
@else
@php
    $role = auth()->user()->roles->first()->name ?? '';
@endphp
<div class="row g-3">
    <!-- Total Students -->
    <div class="col-md-3 col-sm-6">
        <div class="shadow card border-left-primary">
            <div class="text-center card-body">
                <i class="mb-2 bi bi-people fs-2 text-primary"></i>
                <h6 class="text-uppercase font-weight-bold">Total Students</h6>
                <p class="mb-0">{{ \App\Models\Student::count() }}</p>
            </div>
        </div>
    </div>

    <!-- Total Teachers (only for Super Admin) -->
    @if($role === 'Super Admin')
    <div class="col-md-3 col-sm-6">
        <div class="shadow card border-left-success">
            <div class="text-center card-body">
                <i class="mb-2 bi bi-person-badge fs-2 text-success"></i>
                <h6 class="text-uppercase font-weight-bold">Total Teachers</h6>
                <p class="mb-0">{{ \App\Models\Teacher::count() }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Total Classes -->
    <div class="col-md-3 col-sm-6">
        <div class="shadow card border-left-info">
            <div class="text-center card-body">
                <i class="mb-2 bi bi-building fs-2 text-info"></i>
                <h6 class="text-uppercase font-weight-bold">Total Classes</h6>
                <p class="mb-0">{{ \App\Models\StudentClass::count() }}</p>
            </div>
        </div>
    </div>

    <!-- Total Sections -->
    <div class="col-md-3 col-sm-6">
        <div class="shadow card border-left-warning">
            <div class="text-center card-body">
                <i class="mb-2 bi bi-diagram-3 fs-2 text-warning"></i>
                <h6 class="text-uppercase font-weight-bold">Total Sections</h6>
                <p class="mb-0">{{ \App\Models\StudentSection::count() }}</p>
            </div>
        </div>
    </div>
</div>
@endrole

@endsection
