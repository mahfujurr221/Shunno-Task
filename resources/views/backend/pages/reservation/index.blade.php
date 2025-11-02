@extends('backend.layouts.master')
@section('content')
<div class="card">
    <div class="card-body">
        <form>
            <div class="mt-3 row">
                <!-- Search by Type -->
                <div class="col-md-3">
                    <select name="type" class="form-select">
                        <option value="">Select Status</option>
                        <option value="pending">Pending</option>
                        <option value="reserved">Reserved</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ route('reservations.index') }}" class="btn btn-danger">Clear</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">Reservation List</h4>
            </div>
            <div class="mt-1 col-md-6 text-end">
                <a class="btn btn-primary" href="{{ route('reservations.create') }}">
                    <i class="bi bi-plus"></i> Create Reservation
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <x-table
            :columns="['#', 'Customer Name', 'Phone', 'Number of People', 'Reservation Date', 'Status', 'Action']">
            @forelse($reservations as $key => $data)
            <tr class="text-center">
                <td>{{ $key + 1 + ($reservations->currentPage() - 1) * $reservations->perPage() }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->phone }}</td>
                <td>{{ $data->number_of_people }}</td>
                <td>
                    {{ date('d-m-Y h:i A', strtotime($data->date)) }}
                </td>

                <td>
                    @if($data->status == 'pending')
                    <span class="badge bg-warning text-dark">{{ $data->status }}</span>
                    @elseif($data->status == 'approved')
                    <span class="badge bg-success">{{ $data->status }}</span>
                    @elseif($data->status == 'rejected')
                    <span class="badge bg-danger">{{ $data->status }}</span>
                    @else
                    <span class="badge bg-info text-dark">{{ $data->status }}</span>
                    @endif
                </td>
                
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('reservations.edit', $data->id) }}" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('reservations.destroy', $data->id) }}" method="POST"
                        style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                            onclick="return confirm('Are you sure to delete?')">
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
        <div class="d-flex justify-content-end">
            {{ $reservations->links() }}
        </div>
    </div>

</div>
@endsection

@push('scripts')
@endpush