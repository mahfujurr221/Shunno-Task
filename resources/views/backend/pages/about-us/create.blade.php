@extends('backend.layouts.master')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">Create About Us</h4>
            </div>
            <div class="mt-1 col-md-6 text-end">
                <a class="btn btn-primary" href="{{ route('about-us.index') }}">
                    <i class="bi bi-list"></i> About Us List
                </a>
            </div>
        </div>
    </div>
    <form action="{{ route('about-us.store') }}" method="POST">
        @csrf
        <div class="py-3 card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="row">
                        <div class="mb-2 form-group">
                            <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Title" required>
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-2 form-group">
                            <label class="form-label" for="title">Sub Title </label>
                            <input type="text" class="form-control" name="sub_title" placeholder="Enter Sub Title">
                        </div>

                        <div class="mb-2 form-group">
                            <label class="form-label" for="short_description">Short Description</label>
                            <input type="text" class="form-control" name="short_description"
                                placeholder="Enter Short Description">
                        </div>

                        <div class="mb-3 form-group">
                            <label class="form-label" for="description">Description <span
                                    class="text-danger">*</span></label>
                            <textarea name="description" class="form-control" placeholder="Enter Description" rows="10"
                                required></textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-2 form-group">
                            <label class="form-label" for="about_course_desc">About Course Description</label>
                            <textarea name="about_course_desc" class="form-control" placeholder="Enter Description"
                                rows="10" required></textarea>
                        </div>
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

@push('scripts')
<script>
</script>
@endpush