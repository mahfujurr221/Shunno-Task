@extends('backend.layouts.master')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">Create Branch</h4>
            </div>
            <div class="mt-1 col-md-6 text-end">
                <a class="btn btn-primary" href="{{ route('branches.index') }}">
                    <i class="bi bi-list"></i> Branch List
                </a>
            </div>
        </div>
    </div>

    <form action="{{ route('branches.store') }}" method="POST">
        @csrf
        <div class="py-3 card-body">
            <div class="row">
                <div class="col-md-10 offset-md-1">

                    <div class="mb-3 form-group">
                        <label for="name">Branch Name <span class="text-danger">*</label>
                        <x-input type="text" name="name" placeholder="Enter Branch Name" value="{{ old('name') }}" required/>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 form-group">
                        <label for="email">Branch Email<span class="text-danger">*</span></label>
                        <x-input type="text" name="email" placeholder="Enter Branch Email" value="{{ old('email') }}" required/>
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 form-group">
                        <label for="phone">Branch Phone <span class="text-danger">*</span></label>
                        <x-input type="text" name="phone" placeholder="Enter Branch Phone" value="{{ old('phone') }}" required/>
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 form-group">
                        <label for="address">Branch Address <span class="text-danger">*</span></label>
                        <textarea name="address" class="form-control" placeholder="Enter Branch Address" required>{{ old('address') }}</textarea>
                        @error('address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 form-group">
                        <label for="map">Branch Map <span class="text-danger">*</span></label>
                        <textarea name="map" class="form-control " placeholder="Enter Branch Map" rows="5" required>{{ old('map') }}</textarea>
                        @error('map')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>

                </div>
            </div>

        </div>

        <div class="py-3 text-center card-footer">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>

</div>
@endsection
