@extends('backend.layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">Create Opening Hours</h4>
            </div>
            <div class="mt-1 col-md-6 text-end">
                <a class="btn btn-primary" href="{{ route('opening-hours.index') }}">
                    <i class="bi bi-list"></i> Opening Hours List
                </a>
            </div>
        </div>
    </div>

    <form class="form_container" method="POST" action="{{ route('opening-hours.store') }}">
        @csrf
        <div class="card-body">
            <div class="mt-3 row">
                
                <!-- Day Selection -->
                <div class="mb-2 col-md-12">
                    <label class="form-label">Select Day<span class="text-danger">*</span></label>
                    <select class="form-control {{ $errors->has('day') ? 'is-invalid' : '' }}" name="day" required>
                        <option value="">Select Day</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    </select>
                    @if($errors->has('day'))
                    <div class="invalid-feedback">{{ $errors->first('day') }}</div>
                    @endif
                </div>

                <!-- Opening Time -->
                <div class="mb-2 col-md-6">
                    <label class="form-label">Opening Time</label>
                    <input type="time" class="form-control {{ $errors->has('open_time') ? 'is-invalid' : '' }}" 
                        name="open_time" value="{{ old('open_time') }}">
                    @if($errors->has('open_time'))
                    <div class="invalid-feedback">{{ $errors->first('open_time') }}</div>
                    @endif
                </div>

                <!-- Closing Time -->
                <div class="mb-2 col-md-6">
                    <label class="form-label">Closing Time</label>
                    <input type="time" class="form-control {{ $errors->has('close_time') ? 'is-invalid' : '' }}" 
                        name="close_time" value="{{ old('close_time') }}">
                    @if($errors->has('close_time'))
                    <div class="invalid-feedback">{{ $errors->first('close_time') }}</div>
                    @endif
                </div>

                <!-- Closed Checkbox -->
                <div class="mb-2 col-md-6">
                    <label class="form-label">Is Closed?</label>
                    <select class="form-control {{ $errors->has('is_closed') ? 'is-invalid' : '' }}" name="is_closed">
                        <option value="0" selected> No </option>
                        <option value="1"> Yes (Closed) </option>
                    </select>
                    @if($errors->has('is_closed'))
                    <div class="invalid-feedback">{{ $errors->first('is_closed') }}</div>
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

