@extends('backend.layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">Edit Opening Hours</h4>
            </div>
            <div class="mt-1 col-md-6 text-end">
                <a class="btn btn-primary" href="{{ route('opening-hours.index') }}">
                    <i class="bi bi-list"></i> Opening Hours List
                </a>
            </div>
        </div>
    </div>

    <form class="form_container" method="POST" action="{{ route('opening-hours.update', $openingHour->id) }}">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="mt-3 row">

                <!-- Day Selection (Disabled) -->
                <div class="mb-2 col-md-12">
                    <label class="form-label">Day</label>
                    <input type="text" class="form-control" value="{{ ucfirst($openingHour->day) }}" disabled>
                    <input type="hidden" name="day" value="{{ $openingHour->day }}">
                </div>

                <!-- Opening Time -->
                <div class="mb-2 col-md-6">
                    <label class="form-label">Opening Time</label>
                    <input type="time" class="form-control {{ $errors->has('open_time') ? 'is-invalid' : '' }}" 
                        name="open_time" value="{{ old('open_time', $openingHour->open_time) }}">
                    @if($errors->has('open_time'))
                    <div class="invalid-feedback">{{ $errors->first('open_time') }}</div>
                    @endif
                </div>

                <!-- Closing Time -->
                <div class="mb-2 col-md-6">
                    <label class="form-label">Closing Time</label>
                    <input type="time" class="form-control {{ $errors->has('close_time') ? 'is-invalid' : '' }}" 
                        name="close_time" value="{{ old('close_time', $openingHour->close_time) }}">
                    @if($errors->has('close_time'))
                    <div class="invalid-feedback">{{ $errors->first('close_time') }}</div>
                    @endif
                </div>

                <!-- Closed Checkbox -->
                <div class="mb-2 col-md-6">
                    <label class="form-label">Is Closed?</label>
                    <select class="form-control {{ $errors->has('is_closed') ? 'is-invalid' : '' }}" name="is_closed">
                        <option value="0" {{ $openingHour->is_closed == 0 ? 'selected' : '' }}> No </option>
                        <option value="1" {{ $openingHour->is_closed == 1 ? 'selected' : '' }}> Yes (Closed) </option>
                    </select>
                    @if($errors->has('is_closed'))
                    <div class="invalid-feedback">{{ $errors->first('is_closed') }}</div>
                    @endif
                </div>

            </div>

            <div class="gap-2 py-5 d-grid">
                <button type="submit" class="text-center btn btn-success">Update</button>
            </div>

        </div>
    </form>
</div>
@endsection
