@extends('backend.layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Create Gallery</h4>
    </div>

    <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="row">
                <div class="form-group col-md-3">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image" onchange="previewImage(event)">
                </div>

                <div class="mt-3 form-group col-md-3">
                    <label>Image Preview</label>
                    <div>
                        <img id="imagePreview" src="" alt="Image Preview" class="img-thumbnail"
                            style="max-width: 300px; display: none;">
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="mt-3 btn btn-primary">Save Gallery</button>
        </div>
    </form>
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