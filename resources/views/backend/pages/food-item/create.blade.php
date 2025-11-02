@extends('backend.layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">Add New Food Item</h4>
            </div>
            <div class="mt-1 col-md-6 text-end">
                <a class="btn btn-primary" href="{{ route('food-items.index') }}">
                    <i class="bi bi-list"></i> Food Item List
                </a>
            </div>
        </div>
    </div>

    <form class="form_container" method="POST" action="{{ route('food-items.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="mt-3 row">
                
                <!-- Food Category -->
                <div class="mb-2 col-md-6">
                    <label class="form-label">Category<span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select {{ $errors->has('category_id') ? 'is-invalid' : '' }}" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @if($errors->has('category_id'))
                    <div class="invalid-feedback">{{ $errors->first('category_id') }}</div>
                    @endif
                </div>

                <!-- Food Name -->
                <div class="mb-2 col-md-6">
                    <label class="form-label">Food Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name"
                        placeholder="Enter Food Name" value="{{ old('name') }}" required>
                    @if($errors->has('name'))
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>

                <!-- Price -->
                <div class="mb-2 col-md-6">
                    <label class="form-label">Price<span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" name="price"
                        placeholder="Enter Price" value="{{ old('price') }}" required>
                    @if($errors->has('price'))
                    <div class="invalid-feedback">{{ $errors->first('price') }}</div>
                    @endif
                </div>

                <!-- Food Image -->
                <div class="mb-2 col-md-3">
                    <label class="form-label">Image<span class="text-danger">*</span></label>
                    <input type="file" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" name="image"
                        required>
                    @if($errors->has('image'))
                    <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                    @endif
                </div>

                <!-- Food Image Preview -->
                <div class="mb-2 col-md-3">
                    <img id="previewImage" class="img-fluid" src="{{ asset('backend/img/placeholder.jpg') }}" alt="Image" height="100" width="100">
                </div>

                <!-- Description -->
                <div class="mb-2 col-md-6">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description"
                        placeholder="Enter Description">{{ old('description') }}</textarea>
                    {{-- @if($errors->has('description'))
                    <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                    @endif --}}
                </div>

                <div class="mb-2 col-md-6">
                    <label class="form-label">Serial Number<span class="text-danger">*</span></label>
                    <input type="number" class="form-control {{ $errors->has('serial') ? 'is-invalid' : '' }}" name="serial"
                        placeholder="Enter Serial Number" value="{{ old('serial_') }}" required>
                    @if($errors->has('serial'))
                    <div class="invalid-feedback">{{ $errors->first('serial') }}</div>
                    @endif
                </div>

                <!-- Type -->
                <div class="mb-2 col-md-6">
                    <label class="form-label">Food Type <span class="text-danger">*</span></label>
                    <select name="type" class="form-select {{ $errors->has('type') ? 'is-invalid' : '' }}">
                        <option value="regular" {{ old('type') == 'regular' ? 'selected' : '' }}>Regular</option>
                        <option value="new" {{ old('type') == 'new' ? 'selected' : '' }}>New</option>
                        <option value="popular" {{ old('type') == 'popular' ? 'selected' : '' }}>Popular</option>
                        <option value="special" {{ old('type') == 'special' ? 'selected' : '' }}>Special</option>
                    </select>
                    @if($errors->has('type'))
                    <div class="invalid-feedback">{{ $errors->first('type') }}</div>
                    @endif
                </div>

                <!-- Status -->
                <div class="mb-2 col-md-6">
                    <label class="form-label">Status<span class="text-danger">*</span></label>
                    <select name="status" class="form-select {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @if($errors->has('status'))
                    <div class="invalid-feedback">{{ $errors->first('status') }}</div>
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

@push('scripts')
<script>
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
        if(file){
            var reader = new FileReader();
            reader.onload = function(){
                $("#previewImage").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
    $("input[type=file]").change(function(){
        previewFile(this);
    });
</script>
@endpush