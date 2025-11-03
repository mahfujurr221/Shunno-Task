@extends('backend.layouts.master')
@section('content')
<div class="shadow-sm card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0 card-title">Import Students</h4>
        <a href="{{ route('students.index') }}" class="btn btn-success btn-sm">
            <i class="bi bi-list"></i> Student List
        </a>
    </div>

    <div class="card-body">
        <div class="my-4 row">
            <p class="text-muted">You can import students in bulk using a CSV or XLSX file. Please download the template, fill it out, and upload it below. (Default password will be 123456 if not specified.)</p>
            <div class="col-12">
                <a href="{{ route('template') }}" class="btn btn-success">
                    <i class="bi bi-download"></i> Download Template
                </a>
            </div>
        </div>

        <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label for="file" class="form-label fw-bold">Upload XLSX/CSV</label>
                    <input type="file" name="file" id="file" class="form-control {{ $errors->has('file') ? 'is-invalid' : '' }}" accept=".csv,.xlsx">
                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="mt-2" id="fileNamePreview" style="font-style: italic; color: #555;">No file chosen</div>
                </div>

                <div class="col-md-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-upload"></i> Import Students
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="text-center card-footer text-muted">
        <small>Please make sure the Excel file follows the template format. All fields are required.</small>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const fileInput = document.getElementById('file');
    const fileNamePreview = document.getElementById('fileNamePreview');

    fileInput.addEventListener('change', function() {
        if(this.files && this.files.length > 0) {
            fileNamePreview.textContent = "Selected file: " + this.files[0].name;
        } else {
            fileNamePreview.textContent = "No file chosen";
        }
    });
</script>
@endpush
