@extends('backend.layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="card-title">Headline List</h4>
                </div>
                <div class="col-md-6 text-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="bi bi-plus"></i> Add New Headline
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <x-table :columns="['#', 'Title', 'Status', 'Action']">
                @forelse($headlines as $key => $data)
                    <tr class="text-center">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $data->name }}</td>
                        <td>
                            @if ($data->status == 1)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-info btn-sm editButton" data-bs-toggle="modal"
                                data-bs-target="#editModal" data-id="{{ $data->id }}"
                                data-name="{{ $data->name }}" data-status="{{ $data->status }}" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form action="{{ route('headline.destroy', $data->id) }}" method="POST"
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
                        <td colspan="7" class="text-center">No data found</td>
                    </tr>
                @endforelse
            </x-table>
        </div>
    </div>

    {{-- Add Modal --}}
    <x-modal id="addModal" title="Add New Headline" modalSize="modal-md" action="{{ route('headline.store') }}">
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </x-slot>
        <div class="mb-2 form-group">
            <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
            <x-input type="text" name="name" placeholder="Enter Headline" required />
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>



        <div class="mb-2 form-group">
            <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
            <select name="status" class="form-control" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
            @error('status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </x-modal>


    {{-- Edit Modal --}}
    <x-modal id="editModal" title="Update Headline" modalSize="modal-md" method="POST">
        @csrf
        @method('PUT')
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update changes</button>
        </x-slot>
        <div class="mb-2 form-group">
            <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
            <x-input type="text" name="name" placeholder="Enter Headline" id="edit_name" required />
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>



        <div class="mb-2 form-group">
            <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
            <select name="status" class="form-control" id="edit_status" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
            @error('status')
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
            var status = $(this).data('status');
            var url = "{{ route('headline.update', ':id') }}";
            url = url.replace(':id', id);

            $('#edit_name').val(name);
            $('#edit_status').val(status);
            $('#editModal').find('form').attr('action', url);
        });
    </script>
@endpush
