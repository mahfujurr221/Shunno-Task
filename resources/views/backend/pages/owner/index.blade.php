@extends('backend.layouts.master')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">Owner Update </h4>
            </div>
            <div class="mt-1 col-md-6 text-end">
                <a class="btn btn-primary" href="{{ route('owner.index') }}">
                    <i class="bi bi-list"></i>  Owner
                </a>
            </div>
        </div>
    </div>

    <form action="{{ route('owner.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="py-3 card-body">
            <div class="row">
                <div class="col-md-10 offset-md-1">

                    <div class="mb-3 form-group">
                        <label for="name">Name <span class="text-danger">* </span></label>
                        <x-input type="text" name="name" placeholder="Enter name" value="{{ $data->name?? null }}" required/>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 form-group">
                        <label for="designation"> Designation <span class="text-danger">* </span> </label>
                        <x-input type="text" name="designation" placeholder="Enter Pre Title" value="{{ $data->designation?? null }}" required/>
                        @error('designation')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 form-group">
                        <label for="file_url">Image </label>
                        <input type="file" name="file_url" class="form-control mb-3" >
                        @if (isset($data->file_url))
                            <img src="{{ asset($data->file_url) }}" alt="Image" class="img-fluid" style="max-width: 100px;">

                        @endif
                        @error('file_url')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="mb-3 form-group">
                        <label for="qualification">Qualifications <span class="text-danger">*</span></label>
                        <textarea name="qualification" class="form-control" rows="5" placeholder="Enter Short Description" required>{{ $data->qualification?? null }}</textarea>
                        @error('qualification')
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
