@extends('backend.layouts.master')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">Branch List</h4>
            </div>
            <div class="col-md-6 text-end">
                <a class="btn btn-primary" href="{{ route('branches.create') }}">
                    <i class="bi bi-plus"></i> Add New Branch
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <x-table :columns="['#', 'Branch Name', 'Email', 'Phone', 'Address', 'Action']">
            @forelse ($branches as $key => $data)
            <tr class="text-center">
                <td>{{ $key + 1 }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->phone }}</td>
                <td>{{ $data->address }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('branches.edit', $data->id) }}" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('branches.destroy', $data->id) }}" method="POST"
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
                <td colspan="6" class="text-center">No Data Found</td>
            </tr>
            @endforelse
        </x-table>
    </div>
</div>

@endsection

@push('scripts')
@endpush