@extends('backend.layouts.master')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">Edit Student</h4>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('teachers.index') }}" class="btn btn-primary">
                    <i class="bi bi-list"></i> Teacher List
                </a>
            </div>
        </div>
    </div>

    <form action="{{ route('teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="mt-3 row">
                {{-- First Name --}}
                <div class="mb-2 col-md-6">
                    <label class="form-label">First Name<span class="text-danger">*</span></label>
                    <input class="form-control {{ $errors->has('fname') ? 'is-invalid' : '' }}" 
                           type="text" name="fname" placeholder="Enter First Name" 
                           value="{{ old('fname', $teacher->user->fname) }}">
                    @error('fname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Last Name --}}
                <div class="mb-2 col-md-6">
                    <label class="form-label">Last Name<span class="text-danger">*</span></label>
                    <input class="form-control {{ $errors->has('lname') ? 'is-invalid' : '' }}" 
                           type="text" name="lname" placeholder="Enter Last Name" 
                           value="{{ old('lname', $teacher->user->lname) }}">
                    @error('lname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-2 col-md-6">
                    <label class="form-label">Email<span class="text-danger">*</span></label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                           type="text" name="email" placeholder="Enter Email" 
                           value="{{ old('email', $teacher->user->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Phone --}}
                <div class="mb-2 col-md-6">
                    <label class="form-label">Phone<span class="text-danger">*</span></label>
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" 
                           type="number" name="phone" value="{{ old('phone', $teacher->user->phone) }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Address --}}
                <div class="mb-3 col-md-6">
                    <label class="form-label">Address<span class="text-danger">*</span></label>
                    <textarea name="address" 
                              class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                              placeholder="Enter Address">{{ old('address', $teacher->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Subject --}}
                <div class="mb-3 col-md-6">
                    <label class="form-label">Subject<span class="text-danger">*</span></label>
                    <select name="subject_id" class="form-select {{ $errors->has('subject_id') ? 'is-invalid' : '' }}">
                        <option value="">-- Select Subject --</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}" 
                                {{ old('subject_id', $teacher->subject_id) == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('subject_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Image --}}
                <div class="mb-3 col-md-6">
                    <label class="form-label">Student Image</label>
                    <input type="file" name="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}"
                           accept="image/*" id="imageInput">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="mt-3 text-center">
                        <img id="imagePreview" 
                             src="{{ $teacher->image ? asset($teacher->image) : asset('uploads/user.png') }}"
                             alt="Preview"
                             class="rounded img-thumbnail" 
                             style="max-width: 180px; height: 180px; object-fit: cover;">
                    </div>
                </div>

            </div>
        </div>

        <div class="py-3 text-center card-footer">
            <button type="submit" class="btn btn-success">Update Student</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Image Preview
    document.getElementById('imageInput').addEventListener('change', function (e) {
        const file = e.target.files[0];
        const preview = document.getElementById('imagePreview');
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
