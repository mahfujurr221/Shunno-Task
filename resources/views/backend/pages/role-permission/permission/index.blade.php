@extends('backend.layouts.master')
@section('content')
<div class="card">
    <div class="card-body">
        <form>
            <div class="mt-3 row">
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Search by Name" name="name"
                        value="{{ request()->name }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ route('permissions.index') }}" class="btn btn-danger">Clear</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">Permission List</h4>
            </div>
            <div class="col-md-6 text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPermissionModal">
                    <i class="bi bi-plus"></i> Add New Permission
                </button>
                {{-- <x-button data-bs-toggle="modal" data-bs-target="#addPermissionModal">
                    <i class="bi bi-plus"></i>
                    Add New Permission
                </x-button> --}}
            </div>
        </div>
    </div>
    <div class="card-body">
        <x-table :columns="['#', 'Permission Name', 'Action']">
            @forelse ($permissions as $key => $data)
            <tr class="text-center">
                <td>{{ $key + 1 + ($permissions->currentPage() - 1) * $permissions->perPage() }}</td>
                <td>{{ $data->name }}</td>
                <td>
                    <button class="btn btn-info btn-sm editButton" data-bs-toggle="modal"
                        data-bs-target="#editPermissionModal" data-id="{{ $data->id }}" data-name="{{ $data->name }}"
                        title="Edit">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <form action="{{ route('permissions.destroy', $data->id) }}" method="POST"
                        style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure to delete?')" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">No data found</td>
            </tr>
            @endforelse
        </x-table>
        <div class="d-flex justify-content-end">
            {{ $permissions->links() }}
        </div>
    </div>
</div>

{{-- Add Modal --}}
<x-modal id="addPermissionModal" title="Add New Permission" action="{{ route('permissions.store') }}">
    <x-slot name="footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </x-slot>
    <x-input type="text" name="name" placeholder="Enter Permission Name" />
    @error('name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</x-modal>


<!-- Update Modal -->
<x-modal id="editPermissionModal" title="Update Permission" action="" method="POST">
    @csrf
    @method('PUT')
    <x-slot name="footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update changes</button>
    </x-slot>
    <input class="form-control" id="edit_name" type="text" name="name" placeholder="Enter Permission Name" />
    @error('name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</x-modal>
@endsection


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.editButton');
        const editModal = document.getElementById('editPermissionModal');
        const editNameInput = document.getElementById('edit_name');
        const form = editModal.querySelector('form');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const permissionId = button.getAttribute('data-id');
                const permissionName = button.getAttribute('data-name');

                form.action = `/permissions/${permissionId}`;
                editNameInput.value = permissionName;
            });
        });
        @if ($errors->any())
            new bootstrap.Modal(editModal).show();
        @endif
    });
</script>
@endpush