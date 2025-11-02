@extends('backend.layouts.master')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">Opening Hours</h4>
            </div>
            <div class="mt-1 col-md-6 text-end">
                <a class="btn btn-primary" href="{{ route('opening-hours.create') }}">
                    <i class="bi bi-plus"></i> Create Opening Hour
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <x-table :columns="['#', 'Day', 'Opening Time', 'Closing Time', 'Status', 'Action']">
            @forelse($openingHours as $key => $data)
            <tr class="text-center">
                <td>{{ $key + 1 }}</td>
                <td>{{ ucfirst($data->day) }}</td>
                <td>{{ $data->is_closed ? 'Closed' : $data->open_time }}</td>
                <td>{{ $data->is_closed ? 'Closed' : $data->close_time }}</td>
                <td>
                    <span class="badge {{ $data->is_closed ? 'bg-danger' : 'bg-success' }}">
                        {{ $data->is_closed ? 'Closed' : 'Open' }}
                    </span>
                </td>

                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('opening-hours.edit', $data->id) }}" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('opening-hours.destroy', $data->id) }}" method="POST"
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
                <td colspan="6" class="text-center">No data found</td>
            </tr>
            @endforelse
        </x-table>
    </div>

</div>
@endsection

@push('scripts')
@endpush