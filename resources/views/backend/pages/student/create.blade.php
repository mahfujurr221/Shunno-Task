@extends('backend.layouts.master')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Create Student</h4>
        <a href="{{ route('students.index') }}" class="btn btn-primary"><i class="bi bi-list"></i> Student List</a>
    </div>

    <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Upload CSV/XLSX</label>
            <input type="file" name="file" id="file" class="form-control" accept=".csv, .xlsx">
        </div>
        <button type="submit" class="btn btn-primary">Import Students</button>
        <a href="{{ route('students.template') }}" class="btn btn-success">Download Template</a>
    </form>


    <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="mt-3 row">
                <div class="col-md-6">
                    <label class="form-label">First Name <span class="text-danger">*</span></label>
                    <input type="text" name="fname" value="{{ old('fname') }}"
                        class="form-control {{ $errors->has('fname') ? 'is-invalid' : '' }}"
                        placeholder="Enter First Name">
                    @error('fname')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="lname" value="{{ old('lname') }}"
                        class="form-control {{ $errors->has('lname') ? 'is-invalid' : '' }}"
                        placeholder="Enter Last Name">
                    @error('lname')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Enter Email">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Phone <span class="text-danger">*</span></label>
                    <input type="number" name="phone" value="{{ old('phone') }}"
                        class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" placeholder="Enter Phone">
                    @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Address <span class="text-danger">*</span></label>
                    <textarea name="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                        placeholder="Enter Address">{{ old('address') }}</textarea>
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                    <input type="date" name="dob" value="{{ old('dob') }}"
                        class="form-control {{ $errors->has('dob') ? 'is-invalid' : '' }}">
                    @error('dob')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Class <span class="text-danger">*</span></label>
                    <select name="class_id" class="form-select {{ $errors->has('class_id') ? 'is-invalid' : '' }}">
                        <option value="">-- Select Class --</option>
                        @foreach ($classes as $class)
                        <option value="{{ $class->id }}" {{ old('class_id')==$class->id ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('class_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Section <span class="text-danger">*</span></label>
                    <select name="section_id" class="form-select {{ $errors->has('section_id') ? 'is-invalid' : '' }}">
                        <option value="">-- Select Section --</option>
                        @foreach ($sections as $section)
                        <option value="{{ $section->id }}" {{ old('section_id')==$section->id ? 'selected' : '' }}>
                            {{ $section->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('section_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" name="password"
                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="******">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Password Confirmation <span class="text-danger">*</span></label>
                    <input type="password" name="password_confirmation"
                        class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                        placeholder="******">
                    @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-center col-md-6">
                    <label class="form-label">Student Image</label>
                    <input type="file" name="image" id="imageInput"
                        class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" accept="image/*">
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="mt-3">
                        <img id="imagePreview" src="{{ asset('uploads/user.png') }}" class="rounded img-thumbnail"
                            style="max-width:180px; height:180px; object-fit:cover;">
                    </div>
                </div>
            </div>
        </div>

        <div class="py-3 text-center card-footer">
            <button type="submit" class="btn btn-primary">Create Student</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if(file) {
            const reader = new FileReader();
            reader.onload = e => imagePreview.src = e.target.result;
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = "{{ asset('uploads/students/default.png') }}";
        }
    });
</script>
@endpush