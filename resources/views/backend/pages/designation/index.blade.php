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
                    <a href="{{ route('designations.index') }}" class="btn btn-danger">Clear</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">Designation List</h4>
            </div>
            <div class="col-md-6 text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDesignationModal">
                    <i class="bi bi-plus"></i> Add Designation
                </button>
            </div>
        </div>
    </div>

    <div class="card-body">
        <x-table :columns="['#', 'Name', 'Action']">
            @forelse($designations as $key => $data)
            <tr class="text-center">
                <td>{{ $key + 1 }}</td>
                <td>
                    {{ $data->name }}
                </td>

                {{-- Action buttons for editing and deleting --}}
                <td style="min-width: 100px" class="text-center">
                    <button class="btn btn-info btn-sm editButton" data-bs-toggle="modal"
                        data-bs-target="#editDesignationModal" data-id="{{ $data->id }}" data-name="{{ $data->name }}"
                        title="Edit">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <form action="{{ route('designations.destroy', $data->id) }}" method="POST"
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
                <td colspan="10" class="text-center">No data found</td>
            </tr>
            @endforelse
        </x-table>
    </div>
</div>


{{-- Add Modal --}}
<x-modal id="addDesignationModal" title="Add New Designation" action="{{ route('designations.store') }}">
    <x-slot name="footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </x-slot>

    <div class="mb-3 form-group">
        <label for="name">Designation Name</label>
        <x-input type="text" name="name" placeholder="Enter Designation Name" required />
        @error('name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</x-modal>

{{-- Edit Modal --}}
<x-modal id="editDesignationModal" title="Edit Designation">
    @csrf
    @method('PUT')
    <x-slot name="footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update changes</button>
    </x-slot>

    <div class="mb-3 form-group">
        <label for="edit_name">Designation Name</label>
        <x-input type="text" name="name" id="edit_name" placeholder="Enter Designation Name" required />
        @error('name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</x-modal>
@endsection

@push('scripts')
<script>
    $(document).on('click', '.editButton', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var url = "{{ route('designations.update', ':id') }}";
            url = url.replace(':id', id);

            $('#editDesignationModal form').attr('action', url);
            $('#edit_name').val(name);
        });
        //validation error message
        @if ($errors->any())
            $('#addDesignationModal').modal('show');
        @endif
</script>
@endpush