@extends('backend.layouts.master')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">User Update</h4>
            </div>
            <div class="col-md-6 text-end">
                <a class="btn btn-primary" href="{{ route('users.index') }}" title="User List">
                    <i class="bi bi-list"></i> User List</a>
                </a>
            </div>
        </div>
    </div>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="mt-3 row">

                <div class="mb-2 col-md-6">
                    <label class="form-label">Frist Name <span class="text-danger">*</span></label>
                    <input class="form-control {{ $errors->has('fname') ? 'is-invalid' : '' }}" type="text" name="fname"
                        placeholder="Enter First Name" value="{{ $user->fname??old('fname') }}">
                    @if($errors->has('fname'))
                    <div class="invalid-feedback">{{ $errors->first('fname') }}</div>
                    @endif
                </div>

                <div class="mb-2 col-md-6">
                    <label class="form-label">Last Name<span class="text-danger">*</span></label>
                    <input class="form-control {{ $errors->has('lname') ? 'is-invalid' : '' }}" type="text" name="lname"
                        placeholder="Enter Last Name" value="{{ $user->lname??old('lname') }}">
                    @if($errors->has('lname'))
                    <div class="invalid-feedback">{{ $errors->first('lname') }}</div>
                    @endif
                </div>

                <div class="mb-2 col-md-6">
                    <label class="form-label">Email<span class="text-danger">*</span></label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email"
                        placeholder="Enter Login Email." value="{{ $user->email??old('email') }}">
                    @if($errors->has('email'))
                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <div class="mb-2 col-md-6">
                    <label class="form-label">Phone<span class="text-danger">*</span></label>
                    <input type="number" class="form-control {{$errors->has('phone') ? 'is-invalid' : ''}}" name="phone"
                        value="{{ $user->phone??old('phone') }}">
                </div>

                <div class="mb-2 col-md-6">
                    <label class="form-label">Role<span class="text-danger">*</span></label>
                    <select name="role" class="form-control {{ $errors->has('role') ? 'is-invalid' : '' }} select2"
                        data-placeholder="Select Role" multiple required>
                        <option value="">Select Role</option>
                        @foreach ($roles as $role)
                        <option {{ $user->roles->first()->id == $role->id ? 'selected' : '' }} value="{{ $role->name
                            }}">
                            {{ $role->name }}
                        </option>
                        @endforeach
                    </select>
                    @if($errors->has('role'))
                    <div class="invalid-feedback">{{ $errors->first('role') }}</div>
                    @endif
                </div>

            </div>
        </div>
        <div class="py-3 text-center card-footer">
            <button type="submit" class="btn btn-primary">Update User</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
@endpush