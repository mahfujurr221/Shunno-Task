@extends('backend.layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">Edit Reservation</h4>
            </div>
            <div class="mt-1 col-md-6 text-end">
                <a class="btn btn-primary" href="{{ route('reservations.index') }}">
                    <i class="bi bi-list"></i> Reservation List
                </a>
            </div>
        </div>
    </div>

    <form class="form_container" method="POST" action="{{ route('reservations.update', $reservation->id) }}">
        @csrf
        @method('PUT') <!-- Laravel requires PUT method for updating records -->

        <div class="card-body">
            <div class="mt-3 row">
                
                <!-- Customer Name -->
                <div class="mb-2 col-md-6">
                    <label class="form-label">Customer Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name"
                        value="{{ old('name', $reservation->name) }}" required>
                    @if($errors->has('name'))
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>

                <!-- Phone -->
                <div class="mb-2 col-md-6">
                    <label class="form-label">Phone<span class="text-danger">*</span></label>
                    <input type="text" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" name="phone"
                        value="{{ old('phone', $reservation->phone) }}" required>
                    @if($errors->has('phone'))
                    <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                    @endif
                </div>

                <!-- Number of People -->
                <div class="mb-2 col-md-6">
                    <label class="form-label">Number of People<span class="text-danger">*</span></label>
                    <input type="number" class="form-control {{ $errors->has('number_of_people') ? 'is-invalid' : '' }}" 
                        name="number_of_people" value="{{ old('number_of_people', $reservation->number_of_people) }}" required>
                    @if($errors->has('number_of_people'))
                    <div class="invalid-feedback">{{ $errors->first('number_of_people') }}</div>
                    @endif
                </div>

                <!-- Reservation Date -->
                <div class="mb-2 col-md-6">
                    <label class="form-label">Reservation Date & Time<span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" name="date"
                        value="{{ old('date', date('Y-m-d\TH:i', strtotime($reservation->date))) }}" required>
                    @if($errors->has('date'))
                    <div class="invalid-feedback">{{ $errors->first('date') }}</div>
                    @endif
                </div>

                <!-- Status -->
                <div class="mb-2 col-md-6">
                    <label class="form-label">Status<span class="text-danger">*</span></label>
                    <select name="status" class="form-select {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="reserved" {{ $reservation->status == 'reserved' ? 'selected' : '' }}>Reserved</option>
                        <option value="completed" {{ $reservation->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @if($errors->has('status'))
                    <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                    @endif
                </div>

            </div>

            <div class="gap-2 py-5 d-grid">
                <button type="submit" class="text-center btn btn-primary">Update</button>
            </div>
            
        </div>
    </form>
</div>
@endsection
