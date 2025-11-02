@extends('backend.layouts.master')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">Category List</h4>
            </div>
            <div class="col-md-6 text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    <i class="bi bi-plus"></i> Add New Category
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <x-table :columns="['#', 'Category Name', 'Action']">
            @forelse ($categories as $key => $data)
            <tr class="text-center">
                <td>{{ $key + 1 }}</td>
                <td>{{ $data->name??'' }}</td>
                <td>
                    <button class="btn btn-info btn-sm editButton" data-bs-toggle="modal"
                        data-bs-target="#editCategoryModal" data-id="{{ $data->id }}" data-name="{{ $data->name }}" title="Edit">
                        <i class="bi bi-pencil"></i> 
                    </button>
                    <form action="{{ route('food-categories.destroy', $data->id) }}" method="POST" style="display: inline-block">
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
<x-modal id="addCategoryModal" title="Add New Role" action="{{ route('food-categories.store') }}">
    <x-slot name="footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </x-slot>
    <x-input type="text" name="name" placeholder="Enter Category Name" />
    @error('name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</x-modal>

{{-- Edit Modal --}}
<x-modal id="editCategoryModal" title="Update Category" method="POST">
    @csrf
    @method('PUT')
    <x-slot name="footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update changes</button>
    </x-slot>
    <x-input id="edit_name" type="text" name="name" placeholder="Enter Category Name" value="{{ $data->name??'' }}" />
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

        var url= "{{ route('food-categories.update', ':id') }}";
        url = url.replace(':id', id);

        $('#editCategoryModal form').attr('action', url);
        $('#edit_name').val(name);
        
    });
</script>
@endpush