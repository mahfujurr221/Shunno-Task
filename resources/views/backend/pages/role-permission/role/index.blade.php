@extends('backend.layouts.master')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">Role List</h4>
            </div>
            <div class="col-md-6 text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                    <i class="bi bi-plus"></i> Add New Role
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <x-table :columns="['#', 'Role Name', 'Action']">
            @forelse ($roles as $key => $data)
            <tr class="text-center">
                <td>{{ $key + 1 }}</td>
                <td>{{ $data->name }}</td>
                <td>
                    <a href="{{ route('role.permissions', $data->id) }}" class="btn btn-primary btn-sm" title="Permission">
                        <i class="bi bi-list "></i>  
                        Permission
                    </a>
                    
                    <button class="btn btn-info btn-sm editButton" data-bs-toggle="modal"
                        data-bs-target="#editRoleModal" data-id="{{ $data->id }}" data-name="{{ $data->name }}" title="Edit">
                        <i class="bi bi-pencil"></i> 
                    </button>
                    <form action="{{ route('roles.destroy', $data->id) }}" method="POST" style="display: inline-block">
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
    </div>
</div>

{{-- Add Modal --}}
<x-modal id="addRoleModal" title="Add New Role" action="{{ route('roles.store') }}">
    <x-slot name="footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </x-slot>
    <x-input type="text" name="name" placeholder="Enter Role Name" />
    @error('name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</x-modal>

{{-- Edit Modal --}}
<x-modal id="editRoleModal" title="Update Role" method="POST">
    @csrf
    @method('PUT')
    <x-slot name="footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update changes</button>
    </x-slot>
    <x-input id="edit_name" type="text" name="name" placeholder="Enter Role Name" value="{{ $data->name }}" />
    @error('name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</x-modal>

@endsection

@push('scripts')
<script>
    $(document).on('click', '.editButton', function () {
        var id = $(this).data('id');
        var name = $(this).data('name');

        var url= "{{ route('roles.update', ':id') }}";
        url = url.replace(':id', id);

        $('#editRoleModal form').attr('action', url);
        $('#edit_name').val(name);
        
    });
</script>
@endpush