@extends('backend.layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">Create Reservation</h4>
            </div>
            <div class="mt-1 col-md-6 text-end">
                <a class="btn btn-primary" href="{{ route('reservations.index') }}">
                    <i class="bi bi-list"></i> Reservation List
                </a>
            </div>
        </div>
    </div>

    <form class="form_container" method="POST" action="{{ route('reservations.store') }}">
        @csrf
        <div class="card-body">
            <div class="mt-3 row">
                
                <!-- Customer Name -->
                <div class="mb-2 col-md-6">
                    <label class="form-label">Customer Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name"
                        placeholder="Enter Customer Name" value="{{ old('name') }}" required>
                    @if($errors->has('name'))
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>

                <!-- Phone -->
                <div class="mb-2 col-md-6">
                    <label class="form-label">Phone<span class="text-danger">*</span></label>
                    <input type="text" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" name="phone"
                        placeholder="Enter Phone Number" value="{{ old('phone') }}" required>
                    @if($errors->has('phone'))
                    <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                    @endif
                </div>

                <!-- Number of People -->
                <div class="mb-2 col-md-6">
                    <label class="form-label">Number of People<span class="text-danger">*</span></label>
                    <input type="number" class="form-control {{ $errors->has('number_of_people') ? 'is-invalid' : '' }}" 
                        name="number_of_people" placeholder="Enter Number of People" value="{{ old('number_of_people') }}" required>
                    @if($errors->has('number_of_people'))
                    <div class="invalid-feedback">{{ $errors->first('number_of_people') }}</div>
                    @endif
                </div>

                <!-- Reservation Date -->
                <div class="mb-2 col-md-6">
                    <label class="form-label">Reservation Date & Time<span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" name="date"
                        value="{{ old('date') }}" required>
                    @if($errors->has('date'))
                    <div class="invalid-feedback">{{ $errors->first('date') }}</div>
                    @endif
                </div>

            </div>

            <div class="gap-2 py-5 d-grid">
                <button type="submit" class="text-center btn btn-primary">Save</button>
            </div>
            
        </div>
    </form>
</div>
@endsection
