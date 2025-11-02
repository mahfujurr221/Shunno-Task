@extends('backend.layouts.master')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">Edit Student</h4>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('students.index') }}" class="btn btn-primary">
                    <i class="bi bi-list"></i> Student List
                </a>
            </div>
        </div>
    </div>

    <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="mt-3 row">

                {{-- First Name --}}
                <div class="mb-2 col-md-6">
                    <label class="form-label">First Name<span class="text-danger">*</span></label>
                    <input class="form-control {{ $errors->has('fname') ? 'is-invalid' : '' }}" 
                           type="text" name="fname" placeholder="Enter First Name" 
                           value="{{ old('fname', $student->user->fname) }}">
                    @error('fname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Last Name --}}
                <div class="mb-2 col-md-6">
                    <label class="form-label">Last Name<span class="text-danger">*</span></label>
                    <input class="form-control {{ $errors->has('lname') ? 'is-invalid' : '' }}" 
                           type="text" name="lname" placeholder="Enter Last Name" 
                           value="{{ old('lname', $student->user->lname) }}">
                    @error('lname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-2 col-md-6">
                    <label class="form-label">Email<span class="text-danger">*</span></label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                           type="text" name="email" placeholder="Enter Email" 
                           value="{{ old('email', $student->user->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Phone --}}
                <div class="mb-2 col-md-6">
                    <label class="form-label">Phone<span class="text-danger">*</span></label>
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" 
                           type="number" name="phone" value="{{ old('phone', $student->user->phone) }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Address --}}
                <div class="mb-3 col-md-6">
                    <label class="form-label">Address<span class="text-danger">*</span></label>
                    <textarea name="address" 
                              class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                              placeholder="Enter Address">{{ old('address', $student->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- DOB --}}
                <div class="mb-3 col-md-6">
                    <label class="form-label">Date of Birth<span class="text-danger">*</span></label>
                    <input type="date" name="dob" 
                           value="{{ old('dob', $student->dob) }}"
                           class="form-control {{ $errors->has('dob') ? 'is-invalid' : '' }}">
                    @error('dob')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Class --}}
                <div class="mb-3 col-md-6">
                    <label class="form-label">Class<span class="text-danger">*</span></label>
                    <select name="class_id" class="form-select {{ $errors->has('class_id') ? 'is-invalid' : '' }}">
                        <option value="">-- Select Class --</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}" 
                                {{ old('class_id', $student->class_id) == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('class_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Section --}}
                <div class="mb-3 col-md-6">
                    <label class="form-label">Section<span class="text-danger">*</span></label>
                    <select name="section_id" class="form-select {{ $errors->has('section_id') ? 'is-invalid' : '' }}">
                        <option value="">-- Select Section --</option>
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}" 
                                {{ old('section_id', $student->section_id) == $section->id ? 'selected' : '' }}>
                                {{ $section->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('section_id')
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
                             src="{{ $student->image ? asset($student->image) : asset('uploads/students/default.png') }}" 
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
