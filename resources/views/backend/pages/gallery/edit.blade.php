@extends('backend.layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit Gallery</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $gallery->title }}" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image" onchange="previewImage(event)">
                @if($gallery->image)
                <p><strong>Current Image:</strong></p>
                <img id="imagePreview" src="{{ asset($gallery->image) }}" alt="Gallery Image" width="50">
                @endif
            </div>
            <button type="submit" class="mt-3 btn btn-primary">Update Gallery</button>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block'; // Show the preview
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush