@extends('backend.layouts.master')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">Role :: <b class="logo-orange">{{ $role->name }}</b></h4>
            </div>
            <div class="col-md-6 text-end">
                <button type="button" class="mx-2 btn btn-success btn-sm" id="checkAll">
                    <i class="bi bi-check2-all"></i>
                    Select All
                </button>
                <button type="button" class="btn btn-danger btn-sm" id="uncheckAll">
                    <i class="bi bi-x-circle"></i>
                    Unselect All
                </button>
            </div>

        </div>
    </div>

    <form action="{{ route('role-permissions.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                @foreach ($groupedPermissions as $group => $permissions)
                <div class="col-md-3">
                    <div class="my-3 mb-3 card" style="min-height: 180px;">
                        <div class="card-header">
                            <h5>{{ ucfirst($group) }} Permissions</h5>
                        </div>
                        <div class="py-2 card-body">
                            @foreach ($permissions as $permission)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permission[]"
                                    value="{{ $permission->name }}" id="perm_{{ $permission->id }}" {{
                                    $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                <label class="form-check-label" for="perm_{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="text-center card-footer">
            <button type="submit" class="btn btn-primary">Update Changes</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('checkAll').addEventListener('click', function () {
            document.querySelectorAll('input[name="permission[]"]').forEach(checkbox => checkbox.checked = true);
        });

        document.getElementById('uncheckAll').addEventListener('click', function () {
            document.querySelectorAll('input[name="permission[]"]').forEach(checkbox => checkbox.checked = false);
        });
    });
</script>
@endsection